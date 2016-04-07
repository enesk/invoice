<?php $__env->startSection('content'); ?>

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(trans('labels.frontend.auth.login_box_title')); ?></div>

                <div class="panel-body">

                    <?php echo Form::open(['url' => 'login', 'class' => 'form-horizontal']); ?>


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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <?php echo Form::checkbox('remember'); ?> <?php echo e(trans('labels.frontend.auth.remember_me')); ?>

                                    </label>
                                </div>
                            </div><!--col-md-6-->
                        </div><!--form-group-->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <?php echo Form::submit(trans('labels.frontend.auth.login_button'), ['class' => 'btn btn-primary', 'style' => 'margin-right:15px']); ?>


                                <?php echo link_to('password/reset', trans('labels.frontend.passwords.forgot_password')); ?>

                            </div><!--col-md-6-->
                        </div><!--form-group-->

                    <?php echo Form::close(); ?>


                    <div class="row text-center">
                        <?php echo $socialite_links; ?>

                    </div>
                </div><!-- panel body -->

            </div><!-- panel -->

        </div><!-- col-md-8 -->

    </div><!-- row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>