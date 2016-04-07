@extends('frontend.layouts.master')

@section('content')
  <table id="data-table" class="display table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
      <td>RE-NR.</td>
      <td>Gekauft am</td>
      <th>Titel</th>
      <th>Käufer</th>
      <th>Benutzername</th>
      <th>Versandschein</th>
      <th>Rechnung</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
      <td>RE-NR.</td>
      <td>Gekauft am</td>
      <th>Titel</th>
      <th>Käufer</th>
      <th>Benutzername</th>
      <th>Versandschein</th>
      <th>Rechnung</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($buyers as $buyer)
      <tr>
        <td style="text-align: center;">{{ $buyer->order->invoice->invoice_number}}</td>
        <td>{{ date('d.m.Y', strtotime($buyer->order->order_created_at)) }}</td>
        <td>{{ $buyer->order->items->first()->ebay_item_title }}</td>
        <td>{{ $buyer->first_name.' '.$buyer->last_name}}</td>
        <td>{{ $buyer->ebay_user_id }}</td>
        <td>#</td>
        <td style="text-align: center" class="actions">
          <a style="color: #E22919" href="{{ route('invoice.download', $buyer->order->id) }}" title="{{ $buyer->title }}"><i class="fa fa-file-pdf-o"></i></a>
          &nbsp;&nbsp;&nbsp;<a class="edit" data-invoice-number="{{ $buyer->order->invoice->invoice_number }}" data-invoice-id="{{ $buyer->order->invoice->id }}" style="color: #E22919" href="#!" title="{{ $buyer->title }}"><i class="fa fa-pencil"></i></a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  @include('frontend.invoice.modals.edit')

@section('after-scripts-end')
  <script type="text/javascript">
    $(document).ready(function () {
      $('#data-table').DataTable({
        "order": [[0, 'desc']]
      });
      $("#data-table tbody").on("click", ".actions .edit", function(e) {
        $('#invoice-number').val($(this).data('invoice-number'));
        $('#invoice-id').val($(this).data('invoice-id'));
        $('#edit-form').modal();
      });
    });
  </script>
@stop
@endsection