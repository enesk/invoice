<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(trans('labels.frontend.user.profile.update_information')); ?></div>

                <div class="panel-body">

                    <?php echo Form::model($user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']); ?>


                        <div class="form-group">
                            <?php echo Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-6">
                                <?php echo Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]); ?>

                            </div>
                        </div>

                        <?php if($user->canChangeEmail()): ?>
                            <div class="form-group">
                                <?php echo Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]); ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <?php echo Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']); ?>

                            </div>
                        </div>

                    <?php echo Form::close(); ?>


                </div><!--panel body-->

            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>