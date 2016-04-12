<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
  </button>
  <h4 class="modal-title">Rechnung bearbeiten</h4>
</div>
{!! Form::model('', ['route' => 'invoice.update', 'method' => 'PATCH']) !!}
<div class="modal-body">
  <input type="hidden" name="invoice_id" value="{{ $invoice->id }}"/>
  <div class="form-group row">
    {!! Form::label('invoice_number', 'Rechnungsnummer:', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-12">
      <input name="invoice_number" value="{{ $invoice->invoice_number }}" class="form-control"/>
    </div>
  </div>
  <hr/>
  <input type="hidden" name="buyer_id" value="{{ $invoice->order->buyer->id }}"/>
  <h4>Rechnungsadresse</h4>
  <div class="form-group row">
    @if(empty($invoice->order->buyer->last_name))
      <div class="col-md-12">
        {!! Form::label('invoice_first_name', 'Name:', ['class' => 'control-label']) !!}
        <input name="invoice_first_name" value="{{ $invoice->order->buyer->first_name }}" class="form-control"/>
      </div>
    @else
      <div class="col-md-6">
        {!! Form::label('invoice_first_name', 'Vorname:', ['class' => 'control-label']) !!}
        <input name="invoice_first_name" value="{{ $invoice->order->buyer->first_name }}" class="form-control"/>
      </div>
      <div class="col-md-6">
        {!! Form::label('invoice_last_name', 'Nachname:', ['class' => 'control-label']) !!}
        <input name="invoice_last_name" value="{{ $invoice->order->buyer->last_name }}" class="form-control"/>
      </div>
    @endif
  </div>
  <div class="form-group row">
    @if($invoice->order->buyer->street1 == $invoice->order->buyer->street2 OR empty($invoice->order->buyer->street2))
      <div class="col-md-12">
        {!! Form::label('invoice_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
        <input name="invoice_street1" value="{{ $invoice->order->buyer->street1 }}" class="form-control"/>
      </div>
    @else
      <div class="col-md-6">
        {!! Form::label('invoice_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
        <input name="invoice_street1" value="{{ $invoice->order->buyer->street1 }}" class="form-control"/>
      </div>
      <div class="col-md-6">
        {!! Form::label('invoice_street2', 'Strasse 2:', ['class' => 'control-label']) !!}
        <input name="invoice_street2" value="{{ $invoice->order->buyer->street2 }}" class="form-control"/>
      </div>
    @endif
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      {!! Form::label('invoice_zip', 'PLZ:', ['class' => 'control-label']) !!}
      <input name="invoice_zip" value="{{ $invoice->order->buyer->zip }}" class="form-control"/>
    </div>
    <div class="col-md-6">
      {!! Form::label('invoice_city', 'Stadt:', ['class' => 'control-label']) !!}
      <input name="invoice_city" value="{{ $invoice->order->buyer->city }}" class="form-control"/>
    </div>
  </div>
  @if($invoice->order->buyer->shipment)
    <hr/>
    <input type="hidden" name="shipment_buyer_id" value="{{ $invoice->order->buyer->shipment->id }}"/>
    <h4>Lieferadresse</h4>
    <div class="form-group row">
      @if(empty($invoice->order->buyer->shipment->last_name))
        <div class="col-md-12">
          {!! Form::label('shipment_first_name', 'Name:', ['class' => 'control-label']) !!}
          <input name="shipment_first_name" value="{{ $invoice->order->buyer->shipment->first_name }}" class="form-control"/>
        </div>
      @else
        <div class="col-md-6">
          {!! Form::label('shipment_first_name', 'Vorname:', ['class' => 'control-label']) !!}
          <input name="shipment_first_name" value="{{ $invoice->order->buyer->shipment->first_name }}" class="form-control"/>
        </div>
        <div class="col-md-6">
          {!! Form::label('shipment_last_name', 'Nachname:', ['class' => 'control-label']) !!}
          <input name="shipment_last_name" value="{{ $invoice->order->buyer->shipment->last_name }}" class="form-control"/>
        </div>
      @endif
    </div>
    <div class="form-group row">
      @if($invoice->order->buyer->shipment->street1 == $invoice->order->buyer->shipment->street2 OR empty($invoice->order->buyer->shipment->street2))
        <div class="col-md-12">
          {!! Form::label('shipment_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
          <input name="shipment_street1" value="{{ $invoice->order->buyer->shipment->street1 }}" class="form-control"/>
        </div>
      @else
        <div class="col-md-6">
          {!! Form::label('shipment_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
          <input name="shipment_street1" value="{{ $invoice->order->buyer->shipment->street1 }}" class="form-control"/>
        </div>
        <div class="col-md-6">
          {!! Form::label('shipment_street2', 'Strasse 2:', ['class' => 'control-label']) !!}
          <input name="shipment_street2" value="{{ $invoice->order->buyer->shipment->street2 }}" class="form-control"/>
        </div>
      @endif
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        {!! Form::label('shipment_zip', 'PLZ:', ['class' => 'control-label']) !!}
        <input name="shipment_zip" value="{{ $invoice->order->buyer->shipment->zip }}" class="form-control"/>
      </div>
      <div class="col-md-6">
        {!! Form::label('shipment_city', 'Stadt:', ['class' => 'control-label']) !!}
        <input name="shipment_city" value="{{ $invoice->order->buyer->shipment->city }}" class="form-control"/>
      </div>
    </div>
  @else
    <a class="add-shipment" href="#!">Lieferadresse hinzufügen</a>
    <div class="new-shipment" style="display: none">
      <hr/>
      <input type="hidden" name="shipment_buyer_id" value="new"/>
      <h4>Lieferadresse</h4>
      <div class="form-group row">
        <div class="col-md-6">
          {!! Form::label('shipment_first_name', 'Vorname:', ['class' => 'control-label']) !!}
          <input name="shipment_first_name" value="" class="form-control"/>
        </div>
        <div class="col-md-6">
          {!! Form::label('shipment_last_name', 'Nachname:', ['class' => 'control-label']) !!}
          <input name="shipment_last_name" value="" class="form-control"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-6">
          {!! Form::label('shipment_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
          <input name="shipment_street1" value="" class="form-control"/>
        </div>
        <div class="col-md-6">
          {!! Form::label('shipment_street2', 'Strasse 2:', ['class' => 'control-label']) !!}
          <input name="shipment_street2" value="" class="form-control"/>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-6">
          {!! Form::label('shipment_zip', 'PLZ:', ['class' => 'control-label']) !!}
          <input name="shipment_zip" value="" class="form-control"/>
        </div>
        <div class="col-md-6">
          {!! Form::label('shipment_city', 'Stadt:', ['class' => 'control-label']) !!}
          <input name="shipment_city" value="" class="form-control"/>
        </div>
      </div>
    </div>
  @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
  <button type="submit" class="btn btn-primary">Speichern</button>
</div>
<script type="text/javascript">
  $('.add-shipment').click(function () {
    $('.new-shipment').toggle(800);
  })
</script>
{!! Form::close() !!}