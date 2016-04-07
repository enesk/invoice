<?php $__env->startSection('content'); ?>
  <div class="row">

    <div class="col-md-10 col-md-offset-1">

      <div class="panel panel-default">
        <div class="panel-heading"><?php echo e(trans('navs.frontend.dashboard')); ?></div>

        <div class="panel-body">
          <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo e(trans('navs.frontend.user.my_information')); ?></a>
              </li>
              <li role="presentation">
                <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><?php echo e(trans('navs.frontend.user.settings')); ?></a>
              </li>
            </ul>

            <div class="tab-content">

              <div role="tabpanel" class="tab-pane active" id="profile">
                <table class="table table-striped table-hover table-bordered dashboard-table">
                  <tr>
                    <th><?php echo e(trans('labels.frontend.user.profile.avatar')); ?></th>
                    <td><img src="<?php echo $user->picture; ?>" class="user-profile-image"/></td>
                  </tr>
                  <tr>
                    <th><?php echo e(trans('labels.frontend.user.profile.name')); ?></th>
                    <td><?php echo $user->name; ?></td>
                  </tr>
                  <tr>
                    <th><?php echo e(trans('labels.frontend.user.profile.email')); ?></th>
                    <td><?php echo $user->email; ?></td>
                  </tr>
                  <tr>
                    <th><?php echo e(trans('labels.frontend.user.profile.created_at')); ?></th>
                    <td><?php echo $user->created_at; ?> (<?php echo $user->created_at->diffForHumans(); ?>)</td>
                  </tr>
                  <tr>
                    <th><?php echo e(trans('labels.frontend.user.profile.last_updated')); ?></th>
                    <td><?php echo $user->updated_at; ?> (<?php echo $user->updated_at->diffForHumans(); ?>)</td>
                  </tr>
                  <tr>
                    <th><?php echo e(trans('labels.general.actions')); ?></th>
                    <td>
                      <a href="<?php echo route('frontend.user.profile.edit'); ?>" class="btn btn-primary btn-xs"><?php echo e(trans('labels.frontend.user.profile.edit_information')); ?></a>

                      <?php if($user->canChangePassword()): ?>
                        <a href="<?php echo route('auth.password.change'); ?>" class="btn btn-warning btn-xs"><?php echo e(trans('navs.frontend.user.change_password')); ?></a>
                      <?php endif; ?>
                    </td>
                  </tr>
                </table>
              </div><!--tab panel profile-->
              <div role="tabpanel" class="tab-pane" id="settings">

                <div class="panel-body">

                  <?php echo Form::model($settings, ['route' => 'frontend.user.profile.settings.update', 'class' => 'form-horizontal', 'method' => 'PATCH']); ?>


                  <div class="form-group">
                    <?php echo Form::label('invoice_number', 'Rechnungsnummer:', ['class' => 'col-md-4 control-label']); ?>

                    <div class="col-md-6">
                      <?php echo Form::input('text', 'invoice_number', $settings->invoice_number, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.name')]); ?>

                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <?php echo Form::submit(trans('labels.general.buttons.save'), ['class' => 'btn btn-primary']); ?>

                    </div>
                  </div>

                  <?php echo Form::close(); ?>


                </div><!--panel body-->

              </div><!-- panel -->

            </div>

            </div><!--tab content-->

          </div><!--tab panel-->

        </div><!--panel body-->

      </div><!-- panel -->

    </div><!-- col-md-10 -->

  </div><!-- row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>