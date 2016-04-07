<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo access()->user()->picture; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo access()->user()->name; ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo e(trans('strings.backend.general.status.online')); ?></a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?php echo e(trans('strings.backend.general.search_placeholder')); ?>"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"><?php echo e(trans('menus.backend.sidebar.general')); ?></li>

            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo e(Active::pattern('admin/dashboard')); ?>">
                <a href="<?php echo route('admin.dashboard'); ?>"><span><?php echo e(trans('menus.backend.sidebar.dashboard')); ?></span></a>
            </li>

            <?php if (access()->allow('view-access-management')): ?>
                <li class="<?php echo e(Active::pattern('admin/access/*')); ?>">
                    <a href="<?php echo url('admin/access/users'); ?>"><span><?php echo e(trans('menus.backend.access.title')); ?></span></a>
                </li>
            <?php endif; ?>

            <li class="<?php echo e(Active::pattern('admin/log-viewer*')); ?> treeview">
                <a href="#">
                    <span><?php echo e(trans('menus.backend.log-viewer.main')); ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu <?php echo e(Active::pattern('admin/log-viewer*', 'menu-open')); ?>" style="display: none; <?php echo e(Active::pattern('admin/log-viewer*', 'display: block;')); ?>">
                    <li class="<?php echo e(Active::pattern('admin/log-viewer')); ?>">
                        <a href="<?php echo url('admin/log-viewer'); ?>"><?php echo e(trans('menus.backend.log-viewer.dashboard')); ?></a>
                    </li>
                    <li class="<?php echo e(Active::pattern('admin/log-viewer/logs')); ?>">
                        <a href="<?php echo url('admin/log-viewer/logs'); ?>"><?php echo e(trans('menus.backend.log-viewer.logs')); ?></a>
                    </li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>