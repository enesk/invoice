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

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <style>
    label {
      line-height: 1;
      display: inline-block;
      min-width: 140px;
      font-weight: normal;
    }

    .notice {
      font-size: 10px;
    }

    .details {
      margin-top: 50px;
    }

    .details tbody, .details tfoot {
      font-size: 12px;
    }

    .details thead {
      font-size: 10px;
      font-weight: bold;;
    }

    .footer {
      font-size: 11px;
    }
  </style>
</head>

<body>

<div class="container">
  <table>
    <tr>
      <td width="25%">
        <strong>Günes GmbH</strong><br/>
        Bahnhofstraße 48a<br/>
        D-76437 Rastatt
      </td>
      <td width="50%">
        <strong>T</strong> +49 (0) 7222 789257<br/>
        <strong>F</strong> +49 (0) 7222 938974<br/>
        <strong>E</strong> info@gunes24.de<br/>
        <strong>W</strong> www.gunes24.de
      </td>
      <td width="25%">
        <img src="http://gunes24.de/image/catalog/logo.png" width="300"/>
      </td>
    </tr>
  </table>
  <h2 style="margin-top: 50px;" class="pull-right">RECHNUNG</h2>
  <table class="table table-striped" style="margin-top: 50px; table-layout: fixed">
    <tbody>
    <tr>
      <td>
        <label>Name:</label> <strong><?php echo e($order->buyer->first_name); ?> <?php echo e($order->buyer->last_name); ?></strong>
      </td>
      <td>
        <label>Projektname:</label> <strong>Ra 48a</strong>
      </td>
    </tr>
    <tr>
      <td>
        <label>Firmenname:</label> <strong></strong>
      </td>
      <td>
        <label>Auftragsnummer:</label> <strong></strong>
      </td>
    </tr>
    <tr>
      <td>
        <label>Strasse:</label> <strong><?php echo e($order->buyer->street1); ?> <?php echo e($order->buyer->street2); ?></strong>
      </td>
      <td>
        <label>Rechnungsnummer:</label> <strong><?php echo date('Y'); ?> - <?php echo e($order->invoice->invoice_number); ?></strong>
      </td>
    </tr>
    <tr>
      <td>
        <label>PLZ:</label> <strong><?php echo e($order->buyer->zip); ?></strong>
      </td>
      <td>
        <label>Zahlungsziel:</label> <strong><?php echo e($order->payment_method); ?></strong>
      </td>
    </tr>
    <tr>
      <td>
        <label>Stadt: </label> <strong><?php echo e($order->buyer->city); ?></strong>
      </td>
      <td>
        <label>Datum:</label> <strong><?php echo e(date('d.m.Y', strtotime($order->order_created_at))); ?></strong>
      </td>
    </tr>
    </tbody>
  </table>
  <table class="table table-striped details">
    <thead>
    <tr>
      <td width="60%">BESCHREIBUNG</td>
      <td width="10%">MENGE</td>
      <td width="15%">PREIS/STK.</td>
      <td width="15%">KOSTEN</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($order->items as $item): ?>
    <tr>
      <td><?php echo e($item->ebay_item_title); ?></td>
      <td><?php echo e($item->ebay_qty_purchased); ?></td>
      <td><?php echo e(money_format('%+n', $item->ebay_item_price)); ?> €</td>
      <td><?php echo e(money_format('%+n', $item->ebay_item_price*$item->ebay_qty_purchased)); ?> €</td>
    </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
      <td rowspan="3" colspan="2" class="notice">
        <p>Es gelten unsere allgemeinen Verkaufs-,Lieferung- und Zahlungsbedingungen.</p>
        <p>Sämtliche Ware bleibt bis zur vollständingen Bezahlung unsere Eigentum.</p>
        <p>Fällig</p>
      </td>
      <td width="20%"><strong>ZW.-SUMME</strong></td>
      <td width="20%"><?php echo e(money_format('%+n', $beforeTax)); ?> €</td>
    </tr>
    <tr>
      <td><strong>19 % MWST.</strong></td>
      <td><?php echo e(money_format('%+n', $tax)); ?> €</td>
    </tr>
    <tr>
      <td><strong>GESAMT</strong></td>
      <td><?php echo e(money_format('%+n', $price)); ?> €</td>
    </tr>
    </tfoot>
  </table>
  <hr style="margin-top: 280px"/>
  <footer class="footer">
    <table class="footer">
      <thead>
      <td width="300"></td>
      <td></td>
      </thead>
      <tbody>
      <tr valign="top">
        <td>
          <strong>Informationen</strong><br/>
          Eingetragen im Handelsregister Mannheim HRB 703006<br/>
          Umsatzteuer-ID: DE256739226<br/>
          Steuernummer: 39484/30659 <br/>
          Geschäftsführer: Murat Günes
        </td>
        <td>
          <strong>Bankverbindung</strong><br/>
          Sparkasse Rastatt Gernsbach<br/>
          IBAN : DE03 6655 0070 0000 2284 86 <br/>
          BIC: SOLADES1RAS
        </td>
      </tr>
      </tbody>
    </table>
  </footer>
</div>
</body>
</html>
