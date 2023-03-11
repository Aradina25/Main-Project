<head>
    <title>{{$viewbook->title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="{{ asset('https://code.jquery.com/jquery-3.2.1.slim.min.js')}}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js')}}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js')}}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('validation.js')}}"></script>
    
    
  <!-- Google Fonts -->
  <link href="{{ asset('https://fonts.gstatic.com')}}" rel="preconnect">
  <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}" rel="stylesheet">
  <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

  <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <script src="{{ asset('jquery-3.6.0.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="index.css">
    
   <style>
        #fixed-view{
            position:fixed;
            height:100%;
            width:160px;
        }

        .card{
            width:135px;
        }

        td{
            padding:5px;
        }

        sup{
            color: red;
        }
        .rate {
            float: left;
            height: 30px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:20px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        .checked {
          color: #ffc700;
        }

   </style>
</head>
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
<div id="dashboard">
<div id="view-spec-book">
            
    <div id="mid-view" class="child-element" style="background:white;">
            <div id="fixed-view" style="margin-left:40px;margin-top:50px;">
                <img src="{{ asset('coverpics/'.$viewbook->cov_pic)}}" id="cov-pic" width=150px; height=200px;><br><br>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:200px;">
                        Save to Library
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="/login">Want to Read</a>
                        <a class="dropdown-item" href="/login">Currently Reading</a>
                        <a class="dropdown-item" href="/login">Read</a>
                    </div>
                </div>
                <table style="width:220px;">
                    <tr>
                        <td>HardCover</td>
                        @if(empty($pricehc)!=1)
                            @if($pricehc->discount == 0)
                                <td>₹{{$pricehc->price}}</td>
                            @else
                            <td><s>₹{{$pricehc->price}}</s> ₹{{($pricehc->price)-(($pricehc->discount*$pricehc->price)/100)}}<sup> {{$pricehc->discount}}% off</sup> </td>                          
                            @endif
                        @else
                            <td>Out of stock</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Paperback</td>
                        @if(empty($pricepb)!=1)
                            @if($pricepb->discount == 0)
                                <td>₹{{$pricepb->price}}</td>
                            @else
                            <td><s>₹{{$pricepb->price}}</s>  ₹{{($pricepb->price)-(($pricepb->discount*$pricepb->price)/100)}}<sup> {{$pricepb->discount}}% off</sup></td>
                            @endif
                        @else
                            <td>Out of stock</td>
                        @endif                        
                    </tr>
                    <tr>
                        <td>EBook</td>
                        @if(empty($priceeb)!=1)
                            @if($priceeb->discount == 0)
                                <td>₹{{$priceeb->price}}</td>
                            @else
                            <td><s>₹{{$priceeb->price}}</s> ₹{{($priceeb->price)-(($priceeb->discount*$priceeb->price)/100)}}<sup> {{$priceeb->discount}}% off</sup></td>
                            @endif
                        @else
                            <td>Not Available</td>
                        @endif
                    </tr>
                </table>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:200px;">
                        Add To Cart
                    </button>
                    <div class="dropdown-menu">
                        @if(empty($pricehc)!=1)
                            <a class="dropdown-item" href="/login">Hardcover</a>
                        @endif
                        @if(empty($pricepb)!=1)
                            <a class="dropdown-item" href="/login">Paperback</a>
                        @endif
                        @if(empty($priceeb)!=1)
                            <a class="dropdown-item" href="/login">E-Book</a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div id="rest-view" style="margin-left:350px;width:800px;margin-top:50px;"><br>
                <h2>{{$viewbook->title}} - {{$viewbook->author}}</h2>
                @php($rate = $viewbook->rating)
                @for($i = 0; $i < $rate; $i++)
                <span class="fa fa-star checked" style="font-size:20px;"></span>
                @endfor
                @php($rate = 5-$viewbook->rating)
                @for($i = 0; $i < $rate; $i++)
                <span class="fa fa-star" style="font-size:20px;"></span>
                @endfor
                <br><br>

                <p style="text-align: justify">{{$viewbook->summary}}</p>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Book Details
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <table id="spec-book-tab">
                                    <tr>
                                        <td>Genre</td>
                                        <td>{{$viewbook->genre}} </td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        <td>{{$viewbook->language}} </td>
                                    </tr>
                                    <tr>
                                        <td>No.of pages</td>
                                        <td>{{$viewbook->pages}}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td> 
                                        <td>{{$viewbook->ISBN}} </td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>
                                        <td> {{$viewbook->publisher}} </td>
                                    </tr>
                                    <tr>
                                        <td>Publish Date</td>
                                        <td>{{$viewbook->publish_date}} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <p><b>Rate and Review the book</b></p>
                <p style="float:left;margin-top:5px;">Rate :</p>
                    <div class="rate">
                      <input type="radio" id="star5" name="rating" value="5" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="rating" value="4" />
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="rating" value="3" />
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="rating" value="2" />
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="rating" value="1" />
                      <label for="star1" title="text">1 star</label>
                    </div><br><br>
                    <textarea id="review" rows="5" cols="75" name="review" placeholder=" Enter your review"></textarea><br><br>
                    <button class="btn btn-primary" style="width:700px;" onclick="location.href='/login'">Enter</button>
                <br><br>
            @foreach($reviewtab as $posts)
            <article class="post">
                <div class="card mb-3" style="width: 700px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="width:80px;padding-top:10px;">
                            <image id="posts" src="{{ asset('profilepictures/'.$posts->pic->picture)}}" style="width:70px;height:70px;border-radius:50px;"><br>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="text-align:left;padding-bottom:10px;">
                            <!-- <li class="icons dropdown"> -->
                                <br>
                                <p class="card-text"><small class="text-muted">{{$posts->details->fullname}}</small></p>
                                @php($rate = $posts->rating)
                                @for($i = 0; $i < $rate; $i++)
                                <span class="fa fa-star checked" style="font-size:15px;"></span>
                                @endfor
                                @php($rate = 5-$posts->rating)
                                @for($i = 0; $i < $rate; $i++)
                                <span class="fa fa-star" style="font-size:15px;"></span>
                                @endfor
                                <p class="card-text">{{$posts->review}}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </article>
            @endforeach 
                <br><br>
            </div>   
            
            
        </div> 
    </div>
</div>

