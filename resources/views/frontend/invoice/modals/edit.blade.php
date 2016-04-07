<div id="edit-form" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rechnung bearbeiten</h4>
      </div>
      {!! Form::model('', ['route' => 'invoice.update', 'method' => 'PATCH']) !!}
      <div class="modal-body">
        <input type="hidden" value="" name="id" id="invoice-id" />
        <div class="form-group row">
          {!! Form::label('invoice_number', 'Rechnungsnummer:', ['class' => 'col-md-4 control-label']) !!}
          <div class="col-md-12">
            <input name="invoice_number" id="invoice-number" value="" class="form-control" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
        <button type="submit" class="btn btn-primary">Speichern</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->