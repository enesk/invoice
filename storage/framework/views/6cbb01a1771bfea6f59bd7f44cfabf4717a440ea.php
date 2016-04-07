<?php $__env->startSection('title', trans('labels.backend.access.users.management')); ?>

<?php $__env->startSection('page-header'); ?>
    <h1>
        <?php echo e(trans('labels.backend.access.users.management')); ?>

        <small><?php echo e(trans('labels.backend.access.users.active')); ?></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e(trans('labels.backend.access.users.active')); ?></h3>

            <div class="box-tools pull-right">
                <?php echo $__env->make('backend.access.includes.partials.header-buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th><?php echo e(trans('labels.backend.access.users.table.id')); ?></th>
                        <th><?php echo e(trans('labels.backend.access.users.table.name')); ?></th>
                        <th><?php echo e(trans('labels.backend.access.users.table.email')); ?></th>
                        <th><?php echo e(trans('labels.backend.access.users.table.confirmed')); ?></th>
                        <th><?php echo e(trans('labels.backend.access.users.table.roles')); ?></th>
                        <th><?php echo e(trans('labels.backend.access.users.table.other_permissions')); ?></th>
                        <th class="visible-lg"><?php echo e(trans('labels.backend.access.users.table.created')); ?></th>
                        <th class="visible-lg"><?php echo e(trans('labels.backend.access.users.table.last_updated')); ?></th>
                        <th><?php echo e(trans('labels.general.actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo link_to("mailto:".$user->email, $user->email); ?></td>
                                <td><?php echo $user->confirmed_label; ?></td>
                                <td>
                                    <?php if($user->roles()->count() > 0): ?>
                                        <?php foreach($user->roles as $role): ?>
                                            <?php echo $role->name; ?><br/>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php echo e(trans('labels.general.none')); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($user->permissions()->count() > 0): ?>
                                        <?php foreach($user->permissions as $perm): ?>
                                            <?php echo $perm->display_name; ?><br/>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php echo e(trans('labels.general.none')); ?>

                                    <?php endif; ?>
                                </td>
                                <td class="visible-lg"><?php echo $user->created_at->diffForHumans(); ?></td>
                                <td class="visible-lg"><?php echo $user->updated_at->diffForHumans(); ?></td>
                                <td><?php echo $user->action_buttons; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                <?php echo $users->total(); ?> <?php echo e(trans_choice('labels.backend.access.users.table.total', $users->total())); ?>

            </div>

            <div class="pull-right">
                <?php echo $users->render(); ?>

            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>