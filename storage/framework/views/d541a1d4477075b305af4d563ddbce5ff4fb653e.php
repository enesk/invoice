<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(trans('labels.frontend.auth.register_box_title')); ?></div>

                <div class="panel-body">

                    <?php echo Form::open(['url' => 'register', 'class' => 'form-horizontal']); ?>


                        <div class="form-group">
                            <?php echo Form::label('name', trans('validation.attributes.frontend.name'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-6">
                                <?php echo Form::input('name', 'name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]); ?>

                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <?php echo Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-6">
                                <?php echo Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.email')]); ?>

                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <?php echo Form::label('password', trans('validation.attributes.frontend.password'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-6">
                                <?php echo Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password')]); ?>

                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <?php echo Form::label('password_confirmation', trans('validation.attributes.frontend.password_confirmation'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-6">
                                <?php echo Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.password_confirmation')]); ?>

                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <?php echo Form::submit(trans('labels.frontend.auth.register_button'), ['class' => 'btn btn-primary']); ?>

                            </div><!--col-md-6-->
                        </div><!--form-group-->

                    <?php echo Form::close(); ?>


                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>