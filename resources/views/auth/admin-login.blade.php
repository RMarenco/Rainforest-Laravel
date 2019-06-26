<<<<<<< HEAD
<head>
    <title>
        @if (app()->getLocale() == 'en')
            {{ __('messages.login') }}
        @elseif (app()->getLocale() == 'es')
            {{ __('messages.login') }}
        @endif
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

            <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                @csrf
                <span class="login100-form-title">
                    @if (app()->getLocale() == 'en')
                        RAINFOREST {{ __('messages.login') }}
                    @elseif (app()->getLocale() == 'es')
                        {{ __('messages.login') }} DE RAINFOREST
                    @endif
                    
                </span>
                    
                <div class="wrap-input100 validate-input">
                    @if (app()->getLocale() == 'en')
                        <input class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.email') }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @elseif (app()->getLocale() == 'es')
                        <input class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.email') }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @endif
                        
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>  
                <div class="wrap-input100 validate-input">
                    @if (app()->getLocale() == 'en')
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required>
                    @elseif (app()->getLocale() == 'es')
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required>
                    @endif
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
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
                    @if (app()->getLocale() == 'en')
                        <span class="txt1">
                            {{ __('messages.forgot') }}
                        </span>
                        <a class="txt2" href="{{ route('password.request') }}">
                            {{ __('messages.password') }}
                        </a>
                    @elseif (app()->getLocale() == 'es')
                        <span class="txt1">
                            {{ __('messages.forgot') }}
                        </span>
                        <a class="txt2" href="{{ route('password.request') }}">
                            {{ __('messages.password') }}?
                        </a>
                    @endif
                    
                </div>
                <div class="text-center p-t-50">
                    <a class="txt2" href="/register">
                        @if (app()->getLocale() == 'en')
                            {{ __('messages.create_account') }}
                        @elseif (app()->getLocale() == 'es')
                            {{ __('messages.create_account') }}
                        @endif
                        
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="text-center p-t-10">
                    @if (app()->getLocale() == 'en')
                        <span class="txt2">Language:</span>
                    @elseif (app()->getLocale() == 'es')
                        <span class="txt2">Idioma:</span>
                    @endif
        
                    <a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a>

                    <a href="{{ url('locale/es') }}" ><i class="fa fa-language"></i> ES</a>
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
=======
<head>
    <title>
        @if (app()->getLocale() == 'en')
            {{ __('messages.login') }}
        @elseif (app()->getLocale() == 'es')
            {{ __('messages.login') }}
        @endif
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

            <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                @csrf
                <span class="login100-form-title">
                    @if (app()->getLocale() == 'en')
                        RAINFOREST {{ __('messages.login') }}
                    @elseif (app()->getLocale() == 'es')
                        {{ __('messages.login') }} DE RAINFOREST
                    @endif
                    
                </span>
                    
                <div class="wrap-input100 validate-input">
                    @if (app()->getLocale() == 'en')
                        <input class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.email') }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @elseif (app()->getLocale() == 'es')
                        <input class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.email') }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @endif
                        
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>  
                <div class="wrap-input100 validate-input">
                    @if (app()->getLocale() == 'en')
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required>
                    @elseif (app()->getLocale() == 'es')
                        <input class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required>
                    @endif
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
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
                    @if (app()->getLocale() == 'en')
                        <span class="txt1">
                            {{ __('messages.forgot') }}
                        </span>
                        <a class="txt2" href="{{ route('password.request') }}">
                            {{ __('messages.password') }}
                        </a>
                    @elseif (app()->getLocale() == 'es')
                        <span class="txt1">
                            {{ __('messages.forgot') }}
                        </span>
                        <a class="txt2" href="{{ route('password.request') }}">
                            {{ __('messages.password') }}?
                        </a>
                    @endif
                    
                </div>
                <div class="text-center p-t-50">
                    <a class="txt2" href="/register">
                        @if (app()->getLocale() == 'en')
                            {{ __('messages.create_account') }}
                        @elseif (app()->getLocale() == 'es')
                            {{ __('messages.create_account') }}
                        @endif
                        
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="text-center p-t-10">
                    @if (app()->getLocale() == 'en')
                        <span class="txt2">Language:</span>
                    @elseif (app()->getLocale() == 'es')
                        <span class="txt2">Idioma:</span>
                    @endif
        
                    <a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a>

                    <a href="{{ url('locale/es') }}" ><i class="fa fa-language"></i> ES</a>
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
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
