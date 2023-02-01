<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
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
        <div class="form-box">
            <h2>SIGN IN TO YOUR ACCOUNT</h2>
            <form action="/loguser" method="POST">
                @if(Session::has('fail'))
                <span>{{Session::get('fail')}}</span>
                @endif
                @csrf
                @error('uname')
                <span>{{$message}}</span>
                @enderror
                <input type="email" id="uname" name="uname" class="logindetails" placeholder="email"><br><br>
                @error('pass')
                <span>{{$message}}</span>
                @enderror
                <input type="password" id="pass" name="pass" class="logindetails" placeholder="password"><br><br>
                <a style="margin-left: 155px; color:black" href="/forgotpass">Forgot password?</a>
                <br><br>
                <input style="margin-left: 370px;" type="submit" value="SIGN IN" class="btn" name="signin"><br><br>
                <p style="margin-left: 155px;"><b>New to BLounge? <a href="/reg">SIGN UP HERE</b></p>

            </form>
        </div>
    </body>
</html>