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
            <div class="row">
                <?php if(! count($percents)): ?>
                    <div class="col-md-12">
                        There are no statistics to show.
                    </div>
                <?php else: ?>
                    <div class="col-md-3">
                        <canvas id="stats-doughnut-chart"></canvas>
                    </div><!--col-md-3-->
                    <div class="col-md-9">
                        <div class="row">
                            <?php foreach($percents as $level => $item): ?>
                                <div class="col-md-4">
                                    <h5>
                            <span class="level level-<?php echo e($level); ?>">
                                <?php echo log_styler()->icon($level) . ' ' . $item['name']; ?> - <?php echo $item['percent']; ?> %
                            </span>
                                    </h5>
                                    <div class="progress">
                                        <div class="progress-bar level-<?php echo e($level); ?>" role="progressbar" aria-valuenow="<?php echo e($item['percent']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($item['percent']); ?>%">
                                            <?php echo e($item['count']); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div><!--row-->
                    </div><!--col-md-9-->
                <?php endif; ?>
            </div><!--row-->
        </div><!-- /.box-body -->
    </div><!--box box-success-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts-end'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <script>
        Chart.defaults.global.responsive      = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";

        $(function() {
            var data = <?php echo $reports;;; ?>;

            new Chart($('#stats-doughnut-chart')[0].getContext('2d'))
                .Doughnut(data, {
                    animationEasing : "easeOutQuart"
                });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>