<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('login.css')}}">
    <script>
        // to validate password
function check(){
    var reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&])[A-Za-z0-9!@$%*#?&]{6,16}$/; //(?=.*[]) - atleast one
    var pwd = document.getElementById("pass").value;
    if(pwd.match(reg)){
        document.getElementById("perr").innerHTML="";
    }
    else{
        if(pwd.length<6 || pwd.length>16){
            document.getElementById("perr").innerHTML="Password should be between 6-16 characters";
            
        }
        else{
        document.getElementById("perr").innerHTML="Password should have atleast one captial letter, small letter, number and special character";
        }
    }

}

// to confirm password
function checkup(){
    var pwd = document.getElementById("pass").value;
    var copass = document.getElementById("conpass").value;
    if(pwd==copass){
        document.getElementById("errmsg").innerHTML="";
    }
    else{
        document.getElementById("errmsg").innerHTML="Passwords not matching";
    }
}

    </script>
    <style>
        .container{
            margin-top:9%;
            margin-left:20%;
        }
        .form-gap {
            padding-top: 70px;
        }

        body{
            background-image:none;
        }
    </style>
</head>

<body>
<header class="head">       
            <p>BLOUNGE</p>
            <div class="header_nav">
                <nav>
                    <a href="/">HOME &nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a href="/reg">SIGN UP &nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <a href="/login">SIGN IN</a>
                </nav>
            </div>
        </header>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ __('Reset Password') }}</h1></div><br>

                <div class="card-body">
                    <form method="POST" action="/reset-password">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <span id="perr" style="margin-left:300px;"></span><br>
                            <label for="pass" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            
                            <div class="col-md-6">
                                <input id="pass" type="password" class="form-control" name="password" onkeyup="check()" required autocomplete="new-password">
                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <span id="errmsg" style="margin-left:300px;"></span><br>
                            <label for="conpass" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="conpass" type="password" class="form-control" name="password_confirmation" onkeyup="checkup()" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
