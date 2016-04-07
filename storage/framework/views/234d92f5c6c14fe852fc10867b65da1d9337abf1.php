<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-home"></i> <?php echo e(trans('labels.frontend.macros.macro_examples')); ?></div>

                <div class="panel-body">
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.state.us.us')); ?></label>
                        <?php /* Shorthand for this is just selectState, set which version is shorthanded in Macros/Dropdowns */ ?>
                        <?php echo Form::selectStateUS('state', 'NY', ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.state.us.outlying')); ?></label>
                        <?php echo Form::selectStateUSOutlyingTerritories('state_outlying', null, ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.state.us.armed')); ?></label>
                        <?php echo Form::selectStateUSArmedForces('armed_forces', null, ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.territories.canada')); ?></label>
                        <?php echo Form::selectCanadaTerritories('canada_territories', null, ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.state.mexico')); ?></label>
                        <?php echo Form::selectStateMexico('mexico', null, ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.country.alpha')); ?></label>
                        <?php echo Form::selectCountryAlpha('country_alpha', 'ISO 3166-2:US', ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.country.alpha2')); ?></label>
                        <?php /* Shorthand for this is just selectCountry, set which version is shorthanded in Macros/Dropdowns */ ?>
                        <?php echo Form::selectCountryAlpha2('country_alpha2', 'US', ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.country.alpha3')); ?></label>
                        <?php echo Form::selectCountryAlpha3('country_alpha3', 'USA', ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.country.numeric')); ?></label>
                        <?php echo Form::selectCountryNumeric('country_numeric', '840', ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('labels.frontend.macros.timezone')); ?></label>
                        <?php echo Form::selectTimezone('timezone', 'America/New_York', ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div><!-- panel -->

        </div><!-- col-md-10 -->

    </div><!-- row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>