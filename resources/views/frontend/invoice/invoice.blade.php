<?php
  setlocale(LC_MONETARY, 'de_DE.utf8');
?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Rechnung</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div style="margin-top: 20px">
    <div class="pull-left">
      <div style="display: block; height: 65px;">
        &nbsp;
      </div>
      <p style="text-decoration: underline; margin-top: 50px; font-size: 10px;">
        Gunes GmbH - Bahnhofstr. 48a, 76437 Rastatt
      </p>
      <p style="font-size: 12px;">
        {{ $buyer->first_name }} {{ $buyer->last_name }}
        <br/>
        {{ $buyer->street1 }}<br/>
        @if($buyer->street1 != $buyer->street2)
          {{ $buyer->street2 }}<br/>
        @endif
        {{ $buyer->zip }} {{ $buyer->city }}<br/><br/>
      </p>
    </div>
    <div class="pull-right">
      <img src="http://gunes24.de/image/catalog/logo.png" width="200"/>
      <br/>
      <table style="font-size: 12px; margin-top: 50px;">
        <tr>
          <td style="width: 40%;">Telefon:</td>
          <td>+49 7222 - 789257</td>
        </tr>
        <tr>
          <td>Fax:</td>
          <td>+49 7222 - 938974</td>
        </tr>
        <tr>
          <td>E-Mail:</td>
          <td>info@gunes24.de</td>
        </tr>
        <tr>
          <td>Website:</td>
          <td>www.gunes24.de</td>
        </tr>
      </table>

    </div>
    <div class="clearfix"></div>
    <div style="border: 1px solid #000; margin-top: 100px; padding: 10px;">
      <div class="row">
        <span class="col-xs-7" style="font-size: 20px; font-weight: bold;">RECHNUNG</span>
        <span class="col-xs-3" style="font-size: 10px">
          <strong>RECHNUNGSNUMMER:</strong><br/>
          {!! date('Y') !!} - {{ $order->invoice->invoice_number }}
        </span>
        <span class="col-xs-2" style="font-size: 10px">
          <strong>DATUM:</strong><br/>
          {{ date('d.m.Y', strtotime($order->order_created_at)) }}
        </span>
      </div>
    </div>
    @if(isset($buyer['shipment']))
      <p style="margin-top: 30px; margin-bottom: 30px; font-size: 12px;">
        Lieferadresse: {{ $buyer['shipment']->first_name }} {{ $buyer['shipment']->last_name }} -
        {{ $buyer['shipment']->street1 }}
        {{ $buyer['shipment']->street2 }} -
        {{ $buyer['shipment']->zip }}
        {{ $buyer['shipment']->city }}
      </p>
    @endif

    <p style="margin-top: 30px; margin-bottom: 30px; font-size: 12px;">Unsere Lieferungen / Leistungen stellen wir Ihnen wie folgt in
      Rechnung.</p>

    <table class="table table-bordered" style="font-size: 11px;">
      <thead>
      <tr>
        <th style="text-align: center" width="10%">Pos.</th>
        <th width="50%">Bezeichnung</th>
        <th style="text-align: center" width="5%">Menge</th>
        <th style="text-align: center" width="10%">Einzel €</th>
        <th style="text-align: center" width="10%">Ust. %</th>
        <th style="text-align: center" width="15%">Gesamt €</th>
      </tr>
      </thead>
      <tbody>
      @foreach($order->items as $key => $item)
        <tr>
          <td style="text-align: center">{{ ++$key }}</td>
          <td>{{ $item->ebay_item_title }}</td>
          <td style="text-align: center">{{ $item->ebay_qty_purchased }}</td>
          <td style="text-align: center">{{ money_format('%+n', $item->ebay_item_price) }}</td>
          <td style="text-align: center">19%</td>
          <td style="text-align: center">{{ money_format('%+n', $item->ebay_item_price*$item->ebay_qty_purchased) }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div class="pull-left" style="margin-top: 30px; margin-bottom: 30px; font-size: 10px;">
      <p>Es gelten unsere allgemeinen Verkaufs-, Lieferung- und Zahlungsbedingungen.</p>
      <p>Sämtliche Ware bleibt bis zur vollständingen Bezahlung unsere Eigentum.</p>
      <br />
      <p>Besuchen Sie uns auf unserer Website: <span style="color: dodgerblue">www.gunes24.de</span> </p>
    </div>
    <table class="table pull-right" style="font-size: 11px; width: 40%">
      <tbody>
      <tr>
        <td width="70%">
          <strong>Zwischensumme Netto:</strong>
        </td>
        <td style="text-align: right">{{ money_format('%+n', $beforeTax) }}</td>
      </tr>
      <tr>
        <td width="70%"><strong>USt. 19%:</strong></td>
        <td style="text-align: right">{{ money_format('%+n', $tax) }}</td>
      </tr>
      <tr>
        <td width="70%">
          <strong>Gesamt:</strong>
        </td>
        <td style="text-align: right">{{ money_format('%+n', $price) }}</td>
      </tr>
      </tbody>
    </table>
    <div class="clearfix"></div>
    <div style="font-size: 10px; margin-top: 200px; text-align: center;">
      <hr/>
      <div class="row">
        <div class="col-xs-6">
          Geschäftsführer: Murat Günes<br/>
          Eingetragen im Handelsregister Mannheim HRB 703006<br/>
          Umsatzteuer-ID: DE256739226 - Steuernummer: 39484/30659 <br/>
        </div>
        <div class="col-xs-6">
          Bankverbindung<br/>
          Sparkasse Rastatt Gernsbach<br/>
          IBAN : DE03 6655 0070 0000 2284 86 - BIC: SOLADES1RAS
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
