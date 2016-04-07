    <div class="pull-right" style="margin-bottom:10px">
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <?php echo e(trans('menus.backend.access.users.main')); ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo e(route('admin.access.users.index')); ?>"><?php echo e(trans('menus.backend.access.users.all')); ?></a></li>

            <?php if (access()->allow('create-users')): ?>
                <li><a href="<?php echo e(route('admin.access.users.create')); ?>"><?php echo e(trans('menus.backend.access.users.create')); ?></a></li>
            <?php endif; ?>

            <li class="divider"></li>
            <li><a href="<?php echo e(route('admin.access.users.deactivated')); ?>"><?php echo e(trans('menus.backend.access.users.deactivated')); ?></a></li>
            <li><a href="<?php echo e(route('admin.access.users.deleted')); ?>"><?php echo e(trans('menus.backend.access.users.deleted')); ?></a></li>
          </ul>
        </div><!--btn group-->

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <?php echo e(trans('menus.backend.access.roles.main')); ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo e(route('admin.access.roles.index')); ?>"><?php echo e(trans('menus.backend.access.roles.all')); ?></a></li>

            <?php if (access()->allow('create-roles')): ?>
                <li><a href="<?php echo e(route('admin.access.roles.create')); ?>"><?php echo e(trans('menus.backend.access.roles.create')); ?></a></li>
            <?php endif; ?>
          </ul>
        </div><!--btn group-->

        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <?php echo e(trans('menus.backend.access.permissions.main')); ?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">

            <?php if (access()->allow('create-permission-groups')): ?>
                <li><a href="<?php echo e(route('admin.access.roles.permission-group.create')); ?>"><?php echo e(trans('menus.backend.access.permissions.groups.create')); ?></a></li>
            <?php endif; ?>

            <?php if (access()->allow('create-permissions')): ?>
                <li><a href="<?php echo e(route('admin.access.roles.permissions.create')); ?>"><?php echo e(trans('menus.backend.access.permissions.create')); ?></a></li>
            <?php endif; ?>

            <?php if (access()->allowMultiple(['create-permission-groups', 'create-permissions'])): ?>
                <li class="divider"></li>
            <?php endif; ?>

            <li><a href="<?php echo e(route('admin.access.roles.permissions.index')); ?>#all-permissions"><?php echo e(trans('menus.backend.access.permissions.all')); ?></a></li>
            <li><a href="<?php echo e(route('admin.access.roles.permissions.index')); ?>"><?php echo e(trans('menus.backend.access.permissions.groups.all')); ?></a></li>
          </ul>
        </div><!--btn group-->
    </div><!--pull right-->

    <div class="clearfix"></div>
