<head>
    <title>Register</title>
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
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/prin.css">
    <!--===============================================================================================-->
</head>
<
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="more login100-pic js-tilt p-t-9  0" data-tilt>
                <img src="Gallery/images/img-01.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="{{ route('register') }}" method="POST">
                @csrf
                <span class="login100-form-title">
                    Sign in
                </span>

                <div class="wrap-input100 validate-input">
                    <input id="name" type="text" class="input100 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" name="name" value="{{ old('name') }}" required>
                        @if ($errors->has('Name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('Name') }}</strong>
                            </span>
                        @endif
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input id="username" type="text" class="input100 form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="User Name" name="username" value="{{ old('username') }}" required>     
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                </div>


                <div class="wrap-input100 validate-input">
                    <input id="email" type="email" class="input100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('messages.email') }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif                        
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input id="password" type="password" class="input100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <p id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
                        </p>                        
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input">
                    <input id="password-confirm" type="password" class="input100 form-control" placeholder="Confirm Password" name="password_confirmation" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <input type="submit" name="submit" class="login100-form-btn" style="cursor: pointer" value="Register">
                </div>
                <div class="text-center p-t-50">
                    <a class="txt2" href="/login">
                        Already have an account? Login.
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
      </div>
</div>
    <!--===============================================================================================-->  
    <script src="js/jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script >

      $('.js-tilt').tilt({
        scale: 1.1
      })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>