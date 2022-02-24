<!DOCTYPE html>
<html lang="en">
<head>
    <title>Anbar | Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="{{asset('assets/user/register/images/icons/favicon.ico')}}"/>

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/register/css/register.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/register/fonts/iconic/css/material-design-iconic-font.css')}}">
    <!--===============================================================================================-->

</head>
<body style="background-color: #999999;">

<div class="limiter">
    <div class="container-login100">
        <div class="login100-more" style="background-image: url({{asset('assets/user/register/images/bg-02.jpg')}});"></div>

        <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">

            <form class="login100-form validate-form" method="post" action="{{route('register.store')}}">
				@csrf
                <span class="login100-form-title p-b-59">
						Sign Up
					</span>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    &#8226 {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="wrap-input100 validate-input" data-validate="Name is required">
                    <span class="label-input100">Full Name</span>
                    <input class="input100" type="text" name="name" placeholder="Name...">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="email" name="email" placeholder="Email addess...">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <span class="label-input100">Username</span>
                    <input class="input100" type="text" name="user_name" placeholder="Username...">
                    <span class="focus-input100"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <span class="label-input100">Anbar_id</span>
                    <input class="input100" type="text" name="anbar_id" placeholder="Write new anbar id or existing">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" id="password" placeholder="*************">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
                    <span class="label-input100">Repeat Password</span>
                    <input class="input100" type="password" name="password_confirmation" id="password_confirmation" placeholder="*************">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Sign Up
                        </button>
                    </div>
                    <a href="{{route('login.create')}}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                        Sign in
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="{{asset('assets/user/register/js/register.js')}}"></script>
<!--===============================================================================================-->


</body>
</html>
