<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('user.css')}}">
    <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('https://code.jquery.com/jquery-3.2.1.slim.min.js')}}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js')}}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js')}}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('validation.js')}}"></script>
    
    
  <!-- Google Fonts -->
  <link href="{{ asset('https://fonts.gstatic.com')}}" rel="preconnect">
  <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}" rel="stylesheet">
  

  <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <script src="{{ asset('jquery-3.6.0.min.js')}}"></script>
    <title>@yield('title')</title>
    <style>
        body{
            background-image: url("images/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        #dashboard{
            margin-right:7%;
            margin-left:3%;
            margin-top: 50px;
            font-family:cursive;
            display:flex;
            
        }
        

        a:link, a:visited{
            text-decoration:none;
            color:black;
        }
  
    </style>
    </head>
<body>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between" style="margin-right:770px;">
        <h2>BLOUNGE</h2>
    </div ><!-- End Logo -->



        <tr>
            <td>
        <a href="/memhome">
            <!-- <img src="{{ asset('images/globe.jpg')}}" id="feed" alt="feed" class="rounded-circle"> -->
            <span id="boot-icon" class="bi bi-globe" style="font-size: 30px; color: rgb(255, 255, 255);"></span>
        </a>
        </td>
        <td>
        <a href="/cart">
            <!-- <img src="{{ asset('images/cart.jpg')}}" id="cart" alt="cart" class="rounded-circle"> -->
            <span id="boot-icon" class="bi bi-cart" style="font-size: 30px; color: rgb(255, 255, 255); margin-left:20px;margin-top:10px;"></span>
        </a>
        <!-- <li class="nav-item dropdown pe-3"> -->
        </td>
        <td>
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="{{ asset('images/profile.png')}}" id="pro" alt="profile" class="rounded-circle"> -->
            <span id="boot-icon" class="bi bi-person" style="font-size: 30px; color: rgb(255, 255, 255); margin-left:20px;"></span>
            <span class="d-none d-md-block dropdown-toggle ps-2" style="color:white;">@yield('username')</span>
        </a>
        <!-- End Profile Image Icon -->
        </td>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
                <h6>@yield('username')</h6>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item d-flex align-items-center" href="/ownprofile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <a class="dropdown-item d-flex align-items-center" href="/profile">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
            </a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <hr class="dropdown-divider">
            </li>

            <li>
            <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </a>
            </li>

        </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        </tr>
    </ul>
    </nav><!-- End Icons Navigation -->

</header>
<div id="dashboard">
    @yield('content')
</div>
</body>
</html>