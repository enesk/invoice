<?php $__env->startSection('content'); ?>
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
    <?php foreach($buyers as $buyer): ?>
      <tr>
        <td style="text-align: center;"><?php echo e($buyer->order->invoice->invoice_number); ?></td>
        <td><?php echo e(date('d.m.Y', strtotime($buyer->order->order_created_at))); ?></td>
        <td><?php echo e($buyer->order->items->first()->ebay_item_title); ?></td>
        <td><?php echo e($buyer->first_name.' '.$buyer->last_name); ?></td>
        <td><?php echo e($buyer->ebay_user_id); ?></td>
        <td>#</td>
        <td style="text-align: center" class="actions">
          <a style="color: #E22919" href="<?php echo e(route('invoice.download', $buyer->order->id)); ?>" title="<?php echo e($buyer->title); ?>"><i class="fa fa-file-pdf-o"></i></a>
          &nbsp;&nbsp;&nbsp;<a class="edit" data-invoice-number="<?php echo e($buyer->order->invoice->invoice_number); ?>" data-invoice-id="<?php echo e($buyer->order->invoice->id); ?>" style="color: #E22919" href="#!" title="<?php echo e($buyer->title); ?>"><i class="fa fa-pencil"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <?php echo $__env->make('frontend.invoice.modals.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection('after-scripts-end'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>