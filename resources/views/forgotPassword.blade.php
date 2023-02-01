<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
      header{
    position: fixed;
    background-color: #232909;
    height:50px;
    width: 100%;
    display: flex;
    top:0;
}

header p{
    margin-top: 0px;
    margin-left: 60px;
    color: white;
    font-size: 40px;
}
.header_nav{
    padding-top: 15px;
    margin-left: 700px;
    text-decoration: none;
}

.header_nav a{
    text-decoration: none;
    color:white;
}

        .form-gap {
            padding-top: 70px;
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
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Change Password</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="/forget-password">
                    @csrf
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email" value="{{old('email')}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Send Reset Link" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</body>