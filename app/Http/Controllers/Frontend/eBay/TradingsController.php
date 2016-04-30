<?php
    namespace App\Http\Controllers\Frontend\eBay;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Models\eBay\eBayBuyer;
    use App\Models\eBay\eBayOrder;
    use App\Models\eBay\eBayOrderInvoice;
    use Carbon\Carbon;
    use \DTS\eBaySDK\Constants;
    use \DTS\eBaySDK\Trading\Services;
    use \DTS\eBaySDK\Trading\Types;
    use \DTS\eBaySDK\Trading\Enums;
    use Illuminate\Support\Facades\Redirect;

    /**
     * Class DashboardController
     *
     * @package App\Http\Controllers\Frontend
     */
    class TradingsController extends Controller
    {

        protected $service;

        public function __construct()
        {
            $this->service = new Services\TradingService([
                'apiVersion' => 949,
                'siteId'     => Constants\SiteIds::DE,
            ]);
        }

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            if (empty(access()->user()->id)):
                return Redirect::route('auth.login');
            endif;
            $userID = access()->user()->id;
            $data   = [
                'buyers' => eBayBuyer::where('owner_id', $userID)->withIdenticalAddress()->get(),
            ];

            return view('frontend.ebay.dashboard', $data)
                ->withUser(access()->user());
        }

        /**
         * @return mixed
         */
        public function save()
        {
            $order = eBayOrder::orderBy('id', 'desc')->first();
            # 2016-03-29 00:00:00
            # $order->order_created_at
            $data = $this->fetchData($order->order_created_at, Carbon::now());
            foreach ($data as $x):
                if ($x):
                    return Redirect::back()->with('flash_success', 'Sie haben neue Aufträge!');
                endif;

                return Redirect::back()->with('flash_info', 'Sie haben noch keine neue Aufträge!');
            endforeach;
        }

        /**
         * @param $from
         * @param $till
         *
         * @return Types\OrderType[]
         */
        public function getSoldProducts($from, $till)
        {
            $args                                         = [
                "OrderStatus"    => "All",
                "SortingOrder"   => "Descending",
                "OrderRole"      => "Seller",
                "CreateTimeFrom" => new \DateTime($from),
                "CreateTimeTo"   => new \DateTime($till),
            ];
            $request                                      = new Types\GetOrdersRequestType($args);
            $request->RequesterCredentials                = new Types\CustomSecurityHeaderType();
            $request->RequesterCredentials->eBayAuthToken = access()->user()->eBayuser->ebay_token;
            $request->IncludeFinalValueFee                = true;
            $response                                     = $this->service->getOrders($request);
            $soldList                                     = $response->OrderArray->Order;

            return $soldList;
        }

        public function getUsersInvoiceAddress($itemID, $userID)
        {
            $args                                         = [
                'ItemID' => $itemID,
                'UserID' => $userID,
            ];
            $request                                      = new Types\GetUserRequestType($args);
            $request->RequesterCredentials                = new Types\CustomSecurityHeaderType();
            $request->RequesterCredentials->eBayAuthToken = access()->user()->eBayUser->ebay_token;
            $request->DetailLevel[]                       = 'ReturnAll';
            $response                                     = $this->service->getUser($request);

            return $response->User->RegistrationAddress;
        }

        /**
         * @param $from
         * @param $till
         *
         * @return mixed
         */
        public function fetchData($from, $till)
        {
            $fetch = collect($this->getSoldProducts($from, $till))->map(function ($products) {
                $data  = collect($products)->sortBy(function ($product) {
                    if (!isset($product->BuyerUserID)):
                        return false;
                    endif;

                    return $product->CreatedTime->format('Y-m-d H:i:s');
                })->map(function ($product) {
                    if (!isset($product->BuyerUserID) OR eBayOrder::checkOrder($product->OrderID)):
                        return false;
                    endif;;
                    $user     = access()->user();
                    $buyer    = $this->createBuyer($product, $user);
                    $order    = $this->createOrder($product, $buyer);
                    $settings = $user->settings()->firstOrCreate(['user_id' => $user->id]);
                    $settings->increment('invoice_number');
                    $this->createInvoice($user->id, $order->id, $settings->invoice_number);
                    $this->createOrderItems($product, $order);
                });
                $count = $data->count();

                return $count;
            });

            return $fetch;
        }

        /**
         * @param $product
         * @param $order
         */
        public function createOrderItems($product, $order)
        {
            foreach ($product->TransactionArray->Transaction as $transaction):
                $items = [
                    'order_id'            => $order->id,
                    'ebay_item_id'        => $transaction->Item->ItemID,
                    'title'               => $transaction->Item->Title,
                    'qty_purchased'       => $transaction->QuantityPurchased,
                    'price'               => $transaction->TransactionPrice->value,
                    'ebay_transaction_id' => $transaction->TransactionID,
                ];
                $order->items()->create($items);
            endforeach;
        }

        /**
         * @param $userID
         * @param $orderID
         * @param $invoiceNumber
         *
         * @return static
         */
        public function createInvoice($userID, $orderID, $invoiceNumber)
        {
            return eBayOrderInvoice::create([
                'owner_id'       => $userID,
                'order_id'       => $orderID,
                'invoice_number' => $invoiceNumber,
            ]);
        }

        /**
         * @param $product
         * @param $buyer
         *
         * @return mixed
         */
        function createOrder($product, $buyer)
        {
            $orders = [
                'buyer_id'         => $buyer->id,
                'ebay_order_id'    => $product->OrderID,
                'total'            => $product->Total->value,
                'payment_method'   => $product->CheckoutStatus->PaymentMethod,
                'payment_status'   => $product->CheckoutStatus->Status,
                'amount_paid'      => $product->AmountPaid->value,
                'order_created_at' => $product->CreatedTime->format('Y-m-d H:i:s'),
            ];
            $order  = $buyer->order()->create($orders);

            return $order;
        }

        /**
         * @param $product
         * @param $user
         *
         * @return static
         */
        function createBuyer($product, $user)
        {
            $usersInvoiceAddress = $this->getUsersInvoiceAddress($product->TransactionArray->Transaction[0]->Item->ItemID,
                $product->BuyerUserID);
            $shippingAddress     = [
                'owner_id'     => $user->id,
                'ebay_user_id' => $product->BuyerUserID,
                'email'        => $product->TransactionArray->Transaction[0]->Buyer->Email,
                'first_name'   => $product->TransactionArray->Transaction[0]->Buyer->UserFirstName,
                'last_name'    => $product->TransactionArray->Transaction[0]->Buyer->UserLastName,
                'street1'      => $product->ShippingAddress->Street1,
                'street2'      => $product->ShippingAddress->Street2,
                'zip'          => $product->ShippingAddress->PostalCode,
                'city'         => $product->ShippingAddress->CityName,
                'country'      => $product->ShippingAddress->Country,
                'phone'        => $product->ShippingAddress->Phone,
                'address_id'   => $product->ShippingAddress->AddressID,
                'invoice'      => 1,
            ];
            $shipping            = eBayBuyer::create($shippingAddress);
            if (isset($usersInvoiceAddress)):
                if ($product->ShippingAddress->Street1 != $usersInvoiceAddress->Street):
                    $shipping->invoice = 0;
                    $shipping->save();
                    $invoiceAddress = [
                        'owner_id'     => $user->id,
                        'ebay_user_id' => $product->BuyerUserID,
                        'email'        => $product->TransactionArray->Transaction[0]->Buyer->Email,
                        'first_name'   => $usersInvoiceAddress->Name,
                        'last_name'    => '',
                        'street1'      => $usersInvoiceAddress->Street,
                        'street2'      => $usersInvoiceAddress->Street1,
                        'zip'          => $usersInvoiceAddress->PostalCode,
                        'city'         => $usersInvoiceAddress->CityName,
                        'country'      => $usersInvoiceAddress->County,
                        'phone'        => $usersInvoiceAddress->Phone,
                        'address_id'   => $usersInvoiceAddress->AddressID,
                        'invoice'      => 1,
                    ];
                    $invoice        = eBayBuyer::create($invoiceAddress);

                    return $invoice;
                endif;
            endif;

            return $shipping;
        }
    }
