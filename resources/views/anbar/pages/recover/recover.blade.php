<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('assets/user/login/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/user/login/css/login.css')}}">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt >
                <img src="{{asset('assets/user/login/images/img-01.png')}}" alt="IMG" style="margin-top: -55%">
            </div>

            <form class="login100-form validate-form" method="post" action="{{route('recover.store')}}" style="margin-top: -20%">
                @csrf
                <div style="margin-bottom: 20%"><h3>Recover password</h3></div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-danger">
                        {{session('success')}}
                    </div>
                @endif
                <label for="email">Enter your account email address to send a password reset link to it.</label>
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="{{asset('assets/user/login/js/login.js')}}"></script>
<!--===============================================================================================-->

<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
</body>
</html>
