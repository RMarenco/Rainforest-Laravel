<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/Fonts.css"> 
        <meta name="userId" content="<?php echo e(Auth::check() ? Auth::user()->id : 'null'); ?>">
        <meta name="token" id="token" value="<?php echo e(csrf_token()); ?>">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


        <title><?php echo e(config('app.name', 'Laravel')); ?> <?php echo e(app()->version()); ?></title>

        <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar has-shadow">
                <div class="container">
                    <div class="navbar-brand">
                        <a href="<?php echo e(url('/')); ?>" class="navbar-item"><?php echo e(config('app.name', 'Laravel')); ?></a>

                        <div class="navbar-burger burger" data-target="navMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="navbar-menu" id="navMenu">
                        <div class="navbar-start"></div>

                        <div class="navbar-end">
                            <?php if(Auth::guest()): ?>
                                <a class="navbar-item " href="<?php echo e(route('login')); ?>">Login</a>
                                <a class="navbar-item " href="<?php echo e(route('register')); ?>">Register</a>
                            <?php else: ?>
                                <div class="navbar-item has-dropdown is-hoverable">
                                    <a class="navbar-link" href="#"><?php echo e(Auth::user()->name); ?></a>

                                    <div class="navbar-dropdown">
                                        <a class="navbar-item" href="<?php echo e(route('logout')); ?>"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                              style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH D:\rainforest\resources\views/layouts/app.blade.php ENDPATH**/ ?>