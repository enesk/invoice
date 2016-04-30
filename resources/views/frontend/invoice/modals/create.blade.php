<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
  </button>
  <h4 class="modal-title">Auftrag erstellen</h4>
</div>
{!! Form::model('', ['route' => 'invoice.save', 'method' => 'PATCH']) !!}
<div class="modal-body">
  <h4>Rechnungsadresse</h4>
  <div class="form-group row">
    <div class="col-md-6">
      {!! Form::label('invoice_first_name', 'Vorname:', ['class' => 'control-label']) !!}
      <input name="invoice[first_name]" value="" class="form-control" required />
    </div>
    <div class="col-md-6">
      {!! Form::label('invoice_last_name', 'Nachname:', ['class' => 'control-label']) !!}
      <input name="invoice[last_name]" value="" class="form-control" required />
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      {!! Form::label('invoice_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
      <input name="invoice[street1]" value="" class="form-control" required />
    </div>
    <div class="col-md-6">
      {!! Form::label('invoice_street2', 'Strasse 2:', ['class' => 'control-label']) !!}
      <input name="invoice[street2]" value="" class="form-control" />
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      {!! Form::label('invoice_zip', 'PLZ:', ['class' => 'control-label']) !!}
      <input name="invoice[zip]" value="" class="form-control" required />
    </div>
    <div class="col-md-6">
      {!! Form::label('invoice_city', 'Stadt:', ['class' => 'control-label']) !!}
      <input name="invoice[city]" value="" class="form-control" required />
    </div>
  </div>
  <hr/>
  <div class="form-group row">
    <div class="col-md-12">
      <a class="add-shipment" href="#!">Lieferadresse hinzufügen</a>
      <div class="new-shipment" style="display: none">
        <hr/>
        <h4>Lieferadresse</h4>
        <div class="form-group row">
          <div class="col-md-6">
            {!! Form::label('shipment_first_name', 'Vorname:', ['class' => 'control-label']) !!}
            <input name="shipment[first_name]" value="" class="form-control"/>
          </div>
          <div class="col-md-6">
            {!! Form::label('shipment_last_name', 'Nachname:', ['class' => 'control-label']) !!}
            <input name="shipment[last_name]" value="" class="form-control"/>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
            {!! Form::label('shipment_street1', 'Strasse 1:', ['class' => 'control-label']) !!}
            <input name="shipment[street1]" value="" class="form-control"/>
          </div>
          <div class="col-md-6">
            {!! Form::label('shipment_street2', 'Strasse 2:', ['class' => 'control-label']) !!}
            <input name="shipment[street2]" value="" class="form-control"/>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6">
            {!! Form::label('shipment_zip', 'PLZ:', ['class' => 'control-label']) !!}
            <input name="shipment[zip]" value="" class="form-control"/>
          </div>
          <div class="col-md-6">
            {!! Form::label('shipment_city', 'Stadt:', ['class' => 'control-label']) !!}
            <input name="shipment[city]" value="" class="form-control"/>
          </div>
        </div>
      </div>
      <hr/>
      <div id="order-form">
        <div class="item-form">
          <div class="form-group row">
            <div class="col-md-12">
              {!! Form::label('item_title', 'Produktname:', ['class' => 'control-label']) !!}
              <input name="item[0][title]" value="" class="form-control" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              {!! Form::label('item_qty', 'Stückzahl:', ['class' => 'control-label']) !!}
              <input name="item[0][qty_purchased]" value="" class="form-control" required />
            </div>
            <div class="col-md-6">
              {!! Form::label('price', 'Preis pro Produkt in Euro: (bsp. 9.90)', ['class' => 'control-label']) !!}
              <input name="item[0][price]" value="" class="form-control" required />
            </div>
          </div>
          <hr />
        </div>
        <a class="add-product" href="#!">Produkt hinzufügen</a>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
  <button type="submit" class="btn btn-primary">Speichern</button>
</div>
{!! Form::close() !!}
<script type="text/javascript">
  $('.add-shipment').click(function () {
    $( ".new-shipment" ).toggle( "slow", function() {
      // Animation complete.
    });
  });
  $('.add-product').click(function () {
    var newGroup = $('.item-form:last').clone(true);
    newGroup.find('input').each(function(){
      this.name = this.name.replace(/\[(\d+)\]/,function(str,p1){return '[' + (parseInt(p1,10)+1) + ']'});
    }).end().prependTo("#order-form");
  });
</script>