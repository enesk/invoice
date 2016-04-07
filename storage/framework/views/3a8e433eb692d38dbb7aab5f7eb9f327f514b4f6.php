<?php $__env->startSection('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit')); ?>

<?php $__env->startSection('page-header'); ?>
    <h1>
        <?php echo e(trans('labels.backend.access.users.management')); ?>

        <small><?php echo e(trans('labels.backend.access.users.edit')); ?></small>
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::model($user, ['route' => ['admin.access.users.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']); ?>


        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('labels.backend.access.users.edit')); ?></h3>

                <div class="box-tools pull-right">
                    <?php echo $__env->make('backend.access.includes.partials.header-buttons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <?php echo Form::label('name', trans('validation.attributes.backend.access.users.name'), ['class' => 'col-lg-2 control-label']); ?>

                    <div class="col-lg-10">
                        <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.name')]); ?>

                    </div>
                </div><!--form control-->

                <div class="form-group">
                    <?php echo Form::label('email', trans('validation.attributes.backend.access.users.email'), ['class' => 'col-lg-2 control-label']); ?>

                    <div class="col-lg-10">
                        <?php echo Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email')]); ?>

                    </div>
                </div><!--form control-->

                <?php if($user->id != 1): ?>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(trans('validation.attributes.backend.access.users.active')); ?></label>
                        <div class="col-lg-1">
                            <input type="checkbox" value="1" name="status" <?php echo e($user->status == 1 ? 'checked' : ''); ?> />
                        </div>
                    </div><!--form control-->

                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(trans('validation.attributes.backend.access.users.confirmed')); ?></label>
                        <div class="col-lg-1">
                            <input type="checkbox" value="1" name="confirmed" <?php echo e($user->confirmed == 1 ? 'checked' : ''); ?> />
                        </div>
                    </div><!--form control-->

                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(trans('validation.attributes.backend.access.users.associated_roles')); ?></label>
                        <div class="col-lg-3">
                            <?php if(count($roles) > 0): ?>
                                <?php foreach($roles as $role): ?>
                                    <input type="checkbox" value="<?php echo e($role->id); ?>" name="assignees_roles[]" <?php echo e(in_array($role->id, $user_roles) ? 'checked' : ''); ?> id="role-<?php echo e($role->id); ?>" /> <label for="role-<?php echo e($role->id); ?>"><?php echo $role->name; ?></label>
                                        <a href="#" data-role="role_<?php echo e($role->id); ?>" class="show-permissions small">
                                            (
                                                <span class="show-text"><?php echo e(trans('labels.general.show')); ?></span>
                                                <span class="hide-text hidden"><?php echo e(trans('labels.general.hide')); ?></span>
                                                <?php echo e(trans('labels.backend.access.users.permissions')); ?>

                                            )
                                        </a>
                                    <br/>
                                    <div class="permission-list hidden" data-role="role_<?php echo e($role->id); ?>">
                                        <?php if($role->all): ?>
                                            <?php echo e(trans('labels.backend.access.users.all_permissions')); ?><br/><br/>
                                        <?php else: ?>
                                            <?php if(count($role->permissions) > 0): ?>
                                                <blockquote class="small"><?php /*
                                            */ ?><?php foreach($role->permissions as $perm): ?><?php /*
                                            */ ?><?php echo e($perm->display_name); ?><br/>
                                                    <?php endforeach; ?>
                                                </blockquote>
                                            <?php else: ?>
                                                <?php echo e(trans('labels.backend.access.users.no_permissions')); ?><br/><br/>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div><!--permission list-->
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php echo e(trans('labels.backend.access.users.no_roles')); ?>

                            <?php endif; ?>
                        </div>
                    </div><!--form control-->

                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(trans('validation.attributes.backend.access.users.other_permissions')); ?></label>
                        <div class="col-lg-10">
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> <?php echo e(trans('labels.backend.access.users.permission_check')); ?>

                            </div><!--alert-->

                            <?php if(count($permissions)): ?>
                                <?php foreach(array_chunk($permissions->toArray(), 10) as $perm): ?>
                                    <div class="col-lg-3">
                                        <ul style="margin:0;padding:0;list-style:none;">
                                            <?php foreach($perm as $p): ?>
                                                <?php
                                                //Since we are using array format to nicely display the permissions in rows
                                                //we will just manually create an array of dependencies since we do not have
                                                //access to the relationship to use the lists() function of eloquent
                                                //but the relationships are eager loaded in array format now
                                                $dependencies = [];
                                                $dependency_list = [];
                                                if (count($p['dependencies'])) {
                                                    foreach ($p['dependencies'] as $dependency) {
                                                        array_push($dependencies, $dependency['dependency_id']);
                                                        array_push($dependency_list, $dependency['permission']['display_name']);
                                                    }
                                                }
                                                $dependencies = json_encode($dependencies);
                                                $dependency_list = implode(", ", $dependency_list);
                                                ?>

                                                <li><input type="checkbox" value="<?php echo e($p['id']); ?>" name="permission_user[]" data-dependencies="<?php echo $dependencies; ?>" <?php echo e(in_array($p['id'], $user_permissions) ? 'checked' : ""); ?> id="permission-<?php echo e($p['id']); ?>" /> <label for="permission-<?php echo e($p['id']); ?>">

                                                        <?php if($p['dependencies']): ?>
                                                            <a style="color:black;text-decoration:none;" data-toggle="tooltip" data-html="true" title="<strong><?php echo e(trans('labels.backend.access.users.dependencies')); ?>:</strong> <?php echo $dependency_list; ?>"><?php echo $p['display_name']; ?> <small><strong>(D)</strong></small></a>
                                                        <?php else: ?>
                                                            <?php echo $p['display_name']; ?>

                                                        <?php endif; ?>

                                                    </label></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php echo e(trans('labels.backend.access.users.no_other_permissions')); ?>

                            <?php endif; ?>
                        </div><!--col 3-->
                    </div><!--form control-->
                <?php endif; ?>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="<?php echo e(route('admin.access.users.index')); ?>" class="btn btn-danger btn-xs"><?php echo e(trans('buttons.general.cancel')); ?></a>
                </div>

                <div class="pull-right">
                    <input type="submit" class="btn btn-success btn-xs" value="<?php echo e(trans('buttons.general.crud.update')); ?>" />
                </div>
                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <?php if($user->id == 1): ?>
            <?php echo Form::hidden('status', 1); ?>

            <?php echo Form::hidden('confirmed', 1); ?>

            <?php echo Form::hidden('assignees_roles[]', 1); ?>

        <?php endif; ?>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('after-scripts-end'); ?>
    <?php echo Html::script('js/backend/access/permissions/script.js'); ?>

    <?php echo Html::script('js/backend/access/users/script.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>