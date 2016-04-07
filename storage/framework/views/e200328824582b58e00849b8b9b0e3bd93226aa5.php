<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#frontend-navbar-collapse">
                <span class="sr-only"><?php echo e(trans('labels.general.toggle_navigation')); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="<?php echo route('frontend.index'); ?>">
                <?php echo app_name(); ?>

            </a>
        </div><!--navbar-header-->

        <div class="collapse navbar-collapse" id="frontend-navbar-collapse">

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><?php echo link_to_route('frontend.index', trans('navs.frontend.home')); ?></li>
                <li><?php echo link_to_route('ebay', 'Aufträge'); ?></li>
                <li><?php echo link_to_route('ebay.save', 'Speichern'); ?></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <!--
                    <?php if(config('locale.status') && count(config('locale.languages')) > 1): ?>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <?php echo e(trans('menus.language-picker.language')); ?>

                    <span class="caret"></span>
                    </a>

                    <?php echo $__env->make('includes.partials.lang', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </li>
                    <?php endif; ?>
                  !-->

                <!-- Authentication Links -->
                <?php if(Auth::guest()): ?>
                    <li><?php echo link_to('login', trans('navs.frontend.login')); ?></li>
                    <li><?php echo link_to('register', trans('navs.frontend.register')); ?></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo link_to_route('frontend.user.dashboard', trans('navs.frontend.dashboard')); ?></li>

                            <?php if(access()->user()->canChangePassword()): ?>
                                <li><?php echo link_to_route('auth.password.change', trans('navs.frontend.user.change_password')); ?></li>
                            <?php endif; ?>

                            <?php if (access()->allow('view-backend')): ?>
                                <li><?php echo link_to_route('admin.dashboard', trans('navs.frontend.user.administration')); ?></li>
                            <?php endif; ?>

                            <li><?php echo link_to_route('auth.logout', trans('navs.general.logout')); ?></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>