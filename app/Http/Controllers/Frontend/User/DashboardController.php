<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'settings' => access()->user()->settings
        ];
        return view('frontend.user.dashboard', $data)
            ->withUser(access()->user());
    }

    public function saveSettings(Request $request){
        $settings = access()->user()->settings;
        $settings->invoice_number = $request->get('invoice_number');
        $settings->save();

        return Redirect::back()->with('flash_success', 'Ihre Daten wurden gespeichert!');
    }
}
