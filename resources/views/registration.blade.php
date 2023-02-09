<html>
    <head>
        <title>Registration</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="login.css">
        <script src="validation.js"></script>
        <script src="jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            var date = new Date();
            var cYear= date.getFullYear();
            var cDate = date.getMonth();
            $(document).ready(function() {
                $("#dob").datepicker{
                    maxDate : new Date(cYear,cMonth,cDate);
                }
            });
        </script>
            <script type="text/javascript">
                function callbackThen(response) {
                    // read Promise object
                    response.json().then(function(data) {
                        console.log(data);
                        if(data.success && data.score > 0.5) {
                            console.log('valid recpatcha');
                        } else {
                            document.getElementById('registerForm').addEventListener('submit', function(event) {
                                event.preventDefault();
                                alert('recpatcha error');
                            });
                        }
                    });
                }
                
                function callbackCatch(error){
                    console.error('Error:', error)
                }
                </script>
                    
                {!! htmlScriptTagJsApi([
                    'callback_then' => 'callbackThen',
                    'callback_catch' => 'callbackCatch',
                ]) !!}
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
        <div class="form-box" style="height:580px;margin-top:4.8%">
            <form action="/reguser" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 style="padding-bottom:5px">WELCOME TO BLOUNGE</h2>  
            @error('fname')
            <span>{{$message}}</span> 
            @enderror
            <span id="nameerr"></span><br>
            <input type="text" id="fname" name="fname" class="logindetails" placeholder="Enter your full name" onkeyup="ValidateName()" required><br><br>
            <small><label for="dob" style="margin:20%;">Enter your DOB</label></small>
            @error('dob')
            <span>{{$message}}</span>
            @enderror
            <span id="ageerr" style="margin-left:1%;"></span><br>
            <div id="age-verify">
            <input style="width:250px; " type="date" id="dob" name="dob" class="logindetails" max="{{date('Y-m-d')}}" onchange="CalculateAge()" required>
            <input style="width:250px; margin-left: 10px;" type="text" id="age" name="age" class="logindetails" placeholder="Age" readonly>
            </div>
            @error('email')
            <span>{{$message}}</span>
            @enderror
            <span id="emailerr"></span><br>
            <input type="email" id="email" name="email" class="logindetails" placeholder="Enter your email" onkeyup="ValidateEmail()" required><br>
            @error('pass')
            <span>{{$message}}</span>
            @enderror
            <span id="perr"></span><br>
            <input type="password" id="pass" name="pass" class="logindetails" placeholder="Enter a password" onkeyup="check()" required><br>
            <span id="errmsg"></span><br>
            <input type="password" id="conpass" name="pass_confirmation" class="logindetails" placeholder="Re-enter the password" onkeyup="checkup()" required><br>
            <br>
            <input style="margin-left: 370px;" type="submit" value="SIGN UP" class="btn" id="subtn" name="signin"><br>
            <!-- <p style="margin-left: 155px;"><b>Already a member? <a href="/login">SIGN IN</a></b></p> -->
            </form>
        </div>
    </body>
</html>