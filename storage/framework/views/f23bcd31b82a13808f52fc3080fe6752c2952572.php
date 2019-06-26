<head>
    <title>
        <?php if(app()->getLocale() == 'en'): ?>
            <?php echo e(__('messages.login')); ?>

        <?php elseif(app()->getLocale() == 'es'): ?>
            <?php echo e(__('messages.login')); ?>

        <?php endif; ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="Gallery/Icon/r.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/prin.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>


<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" id="image" data-tilt>
                <img src="Gallery/images/img-01.png" id="image" alt="IMG">                                  
            </div>

            <form class="login100-form validate-form" action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <span class="login100-form-title">
                    <?php if(app()->getLocale() == 'en'): ?>
                        RAINFOREST <?php echo e(__('messages.login')); ?>

                    <?php elseif(app()->getLocale() == 'es'): ?>
                        <?php echo e(__('messages.login')); ?> DE RAINFOREST
                    <?php endif; ?>
                    
                </span>
                    
                <div class="wrap-input100 validate-input">
                    <?php if(app()->getLocale() == 'en'): ?>
                        <input class="input100 form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('messages.email')); ?>" type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required>
                    <?php elseif(app()->getLocale() == 'es'): ?>
                        <input class="input100 form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('messages.email')); ?>" type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required>
                    <?php endif; ?>
                        
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>  
                <div class="wrap-input100 validate-input">
                    <?php if(app()->getLocale() == 'en'): ?>
                        <input class="input100 form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" type="password" id="password" name="password" placeholder="<?php echo e(__('messages.password')); ?>" required>
                    <?php elseif(app()->getLocale() == 'es'): ?>
                        <input class="input100 form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" type="password" id="password" name="password" placeholder="<?php echo e(__('messages.password')); ?>" required>
                    <?php endif; ?>
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                
                <div class="wrap-input100 validate-input">
                    <input type="checkbox" name="remember">
                    <span>Remember</span> 
                </div>

                <div class="container-login100-form-btn">
                    <input type="submit" name="submit" id="submit" class="login100-form-btn" style="cursor: pointer" value="Login">
                </div>

                <div class="text-center p-t-12">
                    <?php if(app()->getLocale() == 'en'): ?>
                        <span class="txt1">
                            <?php echo e(__('messages.forgot')); ?>

                        </span>
                        <a class="txt2" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('messages.password')); ?>

                        </a>
                    <?php elseif(app()->getLocale() == 'es'): ?>
                        <span class="txt1">
                            <?php echo e(__('messages.forgot')); ?>

                        </span>
                        <a class="txt2" href="<?php echo e(route('password.request')); ?>">
                            <?php echo e(__('messages.password')); ?>?
                        </a>
                    <?php endif; ?>
                    
                </div>
                <div class="text-center p-t-50">
                    <a class="txt2" href="/register">
                        <?php if(app()->getLocale() == 'en'): ?>
                            <?php echo e(__('messages.create_account')); ?>

                        <?php elseif(app()->getLocale() == 'es'): ?>
                            <?php echo e(__('messages.create_account')); ?>

                        <?php endif; ?>
                        
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="text-center p-t-10">
                    <?php if(app()->getLocale() == 'en'): ?>
                        <span class="txt2">Language:</span>
                    <?php elseif(app()->getLocale() == 'es'): ?>
                        <span class="txt2">Idioma:</span>
                    <?php endif; ?>
        
                    <a href="<?php echo e(url('locale/en')); ?>" ><i class="fa fa-language"></i> EN</a>

                    <a href="<?php echo e(url('locale/es')); ?>" ><i class="fa fa-language"></i> ES</a>
                </div>                
            </form>
                      
        </div>
    </div>
</div>
    <script src="js/jquery.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js">
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<?php /**PATH D:\rainforest\resources\views/auth/login.blade.php ENDPATH**/ ?>