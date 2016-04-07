<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>" />

        <title><?php echo $__env->yieldContent('title', app_name()); ?></title>

        <!-- Meta -->
        <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Default Description'); ?>">
        <meta name="author" content="<?php echo $__env->yieldContent('meta_author', 'Anthony Rappa'); ?>">
        <?php echo $__env->yieldContent('meta'); ?>

        <!-- Styles -->
        <?php echo $__env->yieldContent('before-styles-end'); ?>
        <?php echo Html::style(elixir('css/backend.css')); ?>

        <?php echo $__env->yieldContent('after-styles-end'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-<?php echo config('backend.theme'); ?>">
    <div class="wrapper">
        <?php echo $__env->make('backend.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('backend.includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php echo $__env->yieldContent('page-header'); ?>

                <?php /* Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route */ ?>
                <?php echo Breadcrumbs::renderIfExists(); ?>

            </section>

            <!-- Main content -->
            <section class="content">
                <?php echo $__env->make('includes.partials.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <?php echo $__env->make('backend.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div><!-- ./wrapper -->

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo e(asset('js/vendor/jquery/jquery-2.1.4.min.js')); ?>"><\/script>')</script>
    <?php echo Html::script('js/vendor/bootstrap/bootstrap.min.js'); ?>


    <?php echo $__env->yieldContent('before-scripts-end'); ?>
    <?php echo HTML::script(elixir('js/backend.js')); ?>

    <?php echo $__env->yieldContent('after-scripts-end'); ?>
    </body>
</html>