<?php $__env->startSection('page-header'); ?>
    <h1>
        Log Viewer
        <small>By <a href="https://github.com/ARCANEDEV/LogViewer" target="_blank">ARCANEDEV</a></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-styles-end'); ?>
    <style>
        /* Log level labels & progress bars */
        .label-env {
            padding: 2px 6px;
            background-color: #6A1B9A;
            font-size: .85em;
        }

        span.level {
            padding: 2px 6px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
            border-radius: 2px;
            font-size: .9em;
            font-weight: 600;
        }

        .progress {
            margin-bottom: 10px;
        }

        .progress-bar,
        span.level,
        span.level i {
            color: #FFF;
        }

        span.level.level-empty {
            background-color: <?php echo e(log_styler()->color('empty')); ?>;
        }

        .progress-bar.level-all,
        span.level.level-all,
        .badge.level-all {
            background-color: <?php echo e(log_styler()->color('all')); ?>;
        }

        .progress-bar.level-emergency,
        span.level.level-emergency,
        .badge.level-emergency {
            background-color: <?php echo e(log_styler()->color('emergency')); ?>;
        }

        .progress-bar.level-alert,
        span.level.level-alert,
        .badge.level-alert {
            background-color: <?php echo e(log_styler()->color('alert')); ?>;
        }

        .progress-bar.level-critical,
        span.level.level-critical,
        .badge.level-critical {
            background-color: <?php echo e(log_styler()->color('critical')); ?>;
        }

        .progress-bar.level-error,
        span.level.level-error,
        .badge.level-error {
            background-color: <?php echo e(log_styler()->color('error')); ?>;
        }

        .progress-bar.level-warning,
        span.level.level-warning,
        .badge.level-warning {
            background-color: <?php echo e(log_styler()->color('warning')); ?>;
        }

        .progress-bar.level-notice,
        span.level.level-notice,
        .badge.level-notice {
            background-color: <?php echo e(log_styler()->color('notice')); ?>;
        }

        .progress-bar.level-info,
        span.level.level-info,
        .badge.level-info {
            background-color: <?php echo e(log_styler()->color('info')); ?>;
        }

        .progress-bar.level-debug,
        span.level.level-debug,
        .badge.level-debug {
            background-color: <?php echo e(log_styler()->color('debug')); ?>;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-body">

            <h1 class="page-header"><?php echo e(trans('menus.backend.log-viewer.logs')); ?></h1>

            <?php echo $rows->render(); ?>


            <div class="table-responsive">
                <table class="table table-condensed table-hover table-stats">
                    <thead>
                    <tr>
                        <?php foreach($headers as $key => $header): ?>
                            <th class="<?php echo e($key == 'date' ? 'text-left' : 'text-center'); ?>">
                                <?php if($key == 'date'): ?>
                                    <span class="label label-info"><?php echo e($header); ?></span>
                                <?php else: ?>
                                    <span class="level level-<?php echo e($key); ?>">
                                        <?php echo log_styler()->icon($key) . ' ' . $header; ?>

                                    </span>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; ?>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($rows)): ?>
                        <?php foreach($rows as $date => $row): ?>
                            <tr>
                                <?php foreach($row as $key => $value): ?>
                                    <td class="<?php echo e($key == 'date' ? 'text-left' : 'text-center'); ?>">
                                        <?php if($key == 'date'): ?>
                                            <span class="label label-primary"><?php echo e($value); ?></span>
                                        <?php else: ?>
                                            <span class="level level-<?php echo e($value !== 0 ? $key : 'empty'); ?>">
                                                <?php echo e($value); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <td class="text-right">
                                    <a href="<?php echo e(route('log-viewer::logs.show', [$date])); ?>" class="btn btn-xs btn-info">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="<?php echo e(route('log-viewer::logs.download', [$date])); ?>" class="btn btn-xs btn-success">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-log-date="<?php echo e($date); ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="<?php echo count($headers); ?>">There are no current log files.</td></tr>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr></tr>
                    </tfoot>
                </table>
            </div>

            <?php echo $rows->render(); ?>


        </div><!-- /.box-body -->
    </div><!--box box-success-->

    <?php /* DELETE MODAL */ ?>
    <div id="delete-log-modal" class="modal fade">
        <div class="modal-dialog">
            <form id="delete-log-form" action="<?php echo e(route('log-viewer::logs.delete')); ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="date" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">DELETE LOG FILE</h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts-end'); ?>
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                    deleteLogForm  = $('form#delete-log-form'),
                    submitBtn      = deleteLogForm.find('button[type=submit]');

            $("a[href=#delete-log-modal]").click(function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                        'Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

            deleteLogForm.submit(function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data, textStatus, xhr) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(errorThrown);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function(event) {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>