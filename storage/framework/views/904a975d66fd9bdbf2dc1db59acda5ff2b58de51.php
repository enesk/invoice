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

            <h1 class="page-header">Log [<?php echo e($log->date); ?>]</h1>

            <div class="row">
                <div class="col-md-2">
                    <?php echo $__env->make('log-viewer::_partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Log info :

                            <div class="group-btns pull-right">
                                <a href="<?php echo e(route('log-viewer::logs.download', [$log->date])); ?>" class="btn btn-xs btn-success">
                                    <i class="fa fa-download"></i> DOWNLOAD
                                </a>
                                <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-toggle="modal">
                                    <i class="fa fa-trash-o"></i> DELETE
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td>File path :</td>
                                    <td colspan="5"><?php echo e($log->getPath()); ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Log entries : </td>
                                    <td>
                                    <span class="label label-primary">
                                        <?php echo e($entries->total()); ?>

                                    </span>
                                    </td>
                                    <td>Size :</td>
                                    <td>
                                        <span class="label label-primary"><?php echo e($log->size()); ?></span>
                                    </td>
                                    <td>Created at :</td>
                                    <td>
                                        <span class="label label-primary"><?php echo e($log->createdAt()); ?></span>
                                    </td>
                                    <td>Updated at :</td>
                                    <td>
                                        <span class="label label-primary"><?php echo e($log->updatedAt()); ?></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed" id="entries">
                            <thead>
                            <tr>
                                <td colspan="4"><?php echo $entries->render(); ?></td>
                            </tr>
                            <tr>
                                <th>ENV</th>
                                <th style="width: 120px;">Level</th>
                                <th style="width: 65px;">Time</th>
                                <th>Header</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($entries as $key => $entry): ?>
                                <tr>
                                    <td>
                                <span class="label label-env">
                                    <?php echo e($entry->env); ?>

                                </span>
                                    </td>
                                    <td>
                                <span class="level level-<?php echo e($entry->level); ?>">
                                    <?php echo $entry->level(); ?>

                                </span>
                                    </td>
                                    <td>
                                <span class="label label-default">
                                    <?php echo e($entry->datetime->format('H:i:s')); ?>

                                </span>
                                    </td>
                                    <td>
                                        <p><?php echo e($entry->header); ?></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4"><?php echo $entries->render(); ?></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <?php /* DELETE MODAL */ ?>
            <div id="delete-log-modal" class="modal fade">
                <div class="modal-dialog">
                    <form id="delete-log-form" action="<?php echo e(route('log-viewer::logs.delete')); ?>" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="date" value="<?php echo e($log->date); ?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">DELETE LOG FILE</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to <span class="label label-danger">DELETE</span> this log file <span class="label label-primary"><?php echo e($log->date); ?></span> ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div><!-- /.box-body -->
    </div><!--box box-success-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts-end'); ?>
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                    deleteLogForm  = $('form#delete-log-form'),
                    submitBtn      = deleteLogForm.find('button[type=submit]');

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
                            location.replace("<?php echo e(route('log-viewer::logs.list')); ?>");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
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
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>