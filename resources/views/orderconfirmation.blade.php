@extends('layouts.usertemp')

@section('username',$user->fullname)
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <title>Order Confirmation</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
    body {
    font-family: 'Montserrat', sans-serif
    }
    #dashboard{
            margin-right:7%;
            margin-left:3%;
            margin-top: 50px;
            font-family:cursive;
            display:flex;
            
        }
        #mid-view{
            flex-wrap:wrap;
            margin-left:15%;
            width:800px;
            margin-top:-5%;
            /* border:1px solid black; */
        }
    .card {
    border: none
    }
    .logo {
    background-color: #98AE42;
    }
    .totals tr td {
    font-size: 13px
    }
    .footer {
    background-color: #98AE42;
    }
    .footer span {
    font-size: 12px
    }
    .product-qty span {
    font-size: 12px;
    color: #dedbdb;
    }
  </style>
</head>
<div id="dashboard">
<div id="mid-view" class="child-element" style="width:1100px;margin-top:1%;margin-left:3%;">
    <div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
    <div class="col-md-8">
    <form method="GET" action="/generatePDF" enctype="multipart/form-data">
        <div class="form-group">
          <div class="control">
            <button type="submit" class="btn btn-primary">Download Invoice</button>
          </div>
        </div>
      </form> 
    <div class="card">
    <div class="text-left logo p-2 px-5"> 
      <h3 style="color:white;">BLOUNGE </h3> 
    </div>
    <div class="invoice p-5">
    <h5>Your order Confirmed!</h5> <span class="font-weight-bold d-block mt-4">Hello, {{$user->fullname}}</span> <span>You order has been confirmed and will be shipped soon!</span>
    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
    <table class="table table-borderless">
    <tbody>
    <tr>
    <td>
    <div class="py-2"> <span class="d-block text-muted">Order placed at</span> <span>{{$orders->placed_at}}</span> </div>
    </td>
    <td>
    <div class="py-2"> <span class="d-block text-muted">Order No</span> <span>BL{{$orders->orderid}}</span> </div>
    </td>
    <td>
    <div class="py-2"> <span class="d-block text-muted">Payment</span> <span> PayPal </span> </div>
    </td>
    <td>
    <div class="py-2"> <span class="d-block text-muted">Shipping Address</span> <span>{{$ship->firstname}} {{$ship->lastname}} <br> {{$ship->address}}<br> {{$ship->city}} {{$ship->zipcode}}<br> {{$ship->state}} {{$ship->country}}</span> </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <div class="product border-bottom table-responsive">
    <table class="table table-borderless">
    <tbody>
    @foreach($cart as $item)
    <tr>
    <td width="20%"> <img src="{{ asset('coverpics/'.$item->stocks->products->cov_pic)}}" width="90"> </td>
    <td width="60%"> <span class="font-weight-bold">{{$item->stocks->products->title}}</span>
    <div class="product-qty"> <span class="d-block">Quantity:{{$item->qty}}</span></div>
    <div class="product-qty"> <span class="d-block">Type:{{$item->stocks->type}}</span></div>
    </td>
    <td width="20%">
    @if($item->stocks->discount == 0)
    <div class="text-right"> <span class="font-weight-bold">₹{{$item->qty*$item->stocks->price}}</span> </div>
    @else
    <div class="text-right"> <span class="font-weight-bold"><s>₹{{$item->qty*$item->stocks->price}}</s> ₹{{($item->stocks->price)-(($item->stocks->discount*$item->stocks->price)/100)}}</span> </div>
    @endif
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
    <div class="row d-flex justify-content-end">
    <div class="col-md-5">
    <table class="table table-borderless">
    <tbody class="totals">
    <tr>
    <td>
    <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
    </td>
    <td>
    <div class="text-right"> <span>₹{{$orders->totalamt}}</span> </div>
    </td>
    </tr>
    <tr>
    <td>
    <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
    </td>
    <td>
    @if($orders->totalamt>750)
    <div class="text-right"> <span>₹0</span> </div>
    @else
    <div class="text-right"> <span>₹50</span> </div>
    @endif
    
    </td>
    </tr>
    <!-- <tr>
    <td>
    <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
    </td>
    <td>
    <div class="text-right"> <span>$7.65</span> </div>
    </td>
    </tr> -->
    <!-- <tr>
    <td>
    <div class="text-left"> <span class="text-muted">Discount</span> </div>
    </td>
    <td>
    <div class="text-right"> <span class="text-success">$168.50</span> </div>
    </td>
    </tr> -->
    <tr class="border-top border-bottom">
    <td>
    <div class="text-left"> <span class="font-weight-bold">Subtotal</span> </div>
    </td>
    <td>
    <div class="text-right"> <span class="font-weight-bold">₹{{$orders->paymentamt}}</span> </div>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <div class="d-flex justify-content-between footer p-3"> <span>Need Help? visit our <a href="#"> help center</a></span> <span>{{date("d-m-y h:i:s")}}</span> </div>
    </div>
    </div>
    </div>
    </div> 
</div>
  </div>