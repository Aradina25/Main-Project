@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title',$viewbook->title)
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)
@section('tbr',count($tbr))
@section('curr',count($curr))
@section('done',count($done))
<head>
<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
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
@section('content')
<div id="dashboard">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Reading Challenge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Your Progress</h6>
                    <div class="progress" style="width:455px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: @yield('width')%" aria-valuenow="@yield('comptgoal')" aria-valuemin="0" aria-valuemax="@yield('goal')">@yield('comptgoal')/@yield('goal')</div>
                    </div><br>
                    @if($challenge->goal==0)
                        <h6>Start your challenge</h6>
                        <form action="/challenge" method="POST">
                            @csrf
                                <label for="goalsetter">Set the number of books you will read within 3 months</label>
                                @if(Session::has('ming'))
                                <div class="alert alert-danger" role="alert">{{Session::get('ming')}}</div>
                                @endif
                                <input type="number" id="goalsetter" name="goalsetter">
                                <button type="submit" class="btn btn-primary">Set</button>
                            </form>
                        @else
                        <div class="book-list">
                            <h6>Completed Books</h6>
                            @foreach($librarycheck as $book)
                                <div><a href="{{route('memviewbook',$book->accession_no)}}"><img src="{{asset('coverpics/'.$book->products->cov_pic)}}" alt="{{$book->products->title}}" style="width:50px;height:60px;"></a></div>
                            @endforeach
                        </div>
                    @endif
                        
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ url('/memsearch') }}'">Add completed books</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="MemberLibrary" tabindex="-1" role="dialog" aria-labelledby="MemberLibraryTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="MemberLibraryTitle">Your Shelf</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="book-list">
                        <h6>To Be Read</h6>
                        <tr>
                        @foreach($tbr as $t)
                        <td><a href="{{route('memviewbook',$t->products->accession_no)}}"><img src="{{asset('coverpics/'.$t->products->cov_pic)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <br>
                        <h6>Currently Reading</h6>
                        <tr>
                        @foreach($curr as $c)
                        <td><a href="{{route('memviewbook',$c->products->accession_no)}}"><img src="{{asset('coverpics/'.$c->products->cov_pic)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <br>
                        <h6>Completed</h6>
                        <tr>
                        @foreach($done as $d)
                        <td><a href="{{route('memviewbook',$d->products->accession_no)}}"><img src="{{asset('coverpics/'.$d->products->cov_pic)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <h6>EBooks</h6>
                        <td><a href="https://online.fliphtml5.com/lunzf/oxuu/"><img src="{{asset('coverpics/1663776805cp.jpg')}}" style="width:50px;height:60px;"></a></td>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="window.location='{{ url('/memsearch') }}'">Add More to Library</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="yourstoremodal" tabindex="-1" role="dialog" aria-labelledby="yourstoremodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="yourstoremodalTitle">Your store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="book-list">
                        <h6>Currently on store</h6>
                        <tr>
                        @foreach($tobesold as $t)
                        <td><a href=""><img src="{{asset('coverpics/'.$t->frontcov)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <br>
                        <h6>Sold</h6>
                        <tr>
                        @foreach($soldbooks as $s)
                        <td><a href=""><img src="{{asset('coverpics/'.$s->frontcov)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <br>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addyourstoremodal" >Add to your store</button>
                </div>
                </div>
            </div>
        </div>
<div id="view-spec-book">
            
    <div id="mid-view" class="child-element" style="background:white;">
            <div id="fixed-view">
                <img src="{{ asset('coverpics/'.$viewbook->cov_pic)}}" id="cov-pic"><br><br>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:200px;">
                        Save to Library
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('markbook',['accId'=>$viewbook->accession_no,'stat'=>1])}}">Want to Read</a>
                        <a class="dropdown-item" href="{{route('markbook',['accId'=>$viewbook->accession_no,'stat'=>2])}}">Currently Reading</a>
                        <a class="dropdown-item" href="{{route('markbook',['accId'=>$viewbook->accession_no,'stat'=>3])}}">Read</a>
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
                            <a class="dropdown-item" href="{{route('buybook',['accId'=>$viewbook->accession_no,'stat'=>1])}}">Hardcover</a>
                        @endif
                        @if(empty($pricepb)!=1)
                            <a class="dropdown-item" href="{{route('buybook',['accId'=>$viewbook->accession_no,'stat'=>2])}}">Paperback</a>
                        @endif
                        @if(empty($priceeb)!=1)
                            <a class="dropdown-item" href="{{route('buybook',['accId'=>$viewbook->accession_no,'stat'=>3])}}">E-Book</a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div id="rest-view" style="width:700px">
                <h2>{{$viewbook->title}} - {{$viewbook->author}}</h2>
                @php($rate = $viewbook->rating)
                @for($i = 0; $i < $rate; $i++)
                <span class="fa fa-star checked" style="font-size:20px;"></span>
                @endfor
                @php($rate = 5-$viewbook->rating)
                @for($i = 0; $i < $rate; $i++)
                <span class="fa fa-star" style="font-size:20px;"></span>
                @endfor
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
                        <div id="thrift">
                            @if(count($thrift)>0)
                            <h6><b>Want to thrift?</b></h6>
                            @foreach($thrift as $t)
                                <a href="{{route('viewthrift',['accId'=>$t->bookid,'userid'=>$t->userid])}}"><img src="{{ asset('profilepictures/'.$t->profile->picture)}}" style="width:100px;height:100px;border-radius:50px;"></a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <p><b>Rate and Review the book</b></p>
                <p style="float:left;margin-top:5px;">Rate :</p>
                <form action="{{route('review',$viewbook->accession_no)}}" method="POST">
                @csrf
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
                    <button type="submit" class="btn btn-primary" style="width:700px;">Enter</button>
                </form>
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
            </div>   
            
            
        </div> 
    </div>
</div>

@endsection