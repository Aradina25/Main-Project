@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title',$thrift->btitle)
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)
<style>

    img {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

img:hover {opacity: 0.7;}

/* The Modal (background) */
#image-viewer {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 30;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9);
}
.modal-content {
    margin: auto;
    display: block;
    width: 50%;
    max-width: 700px;
}
.modal-content { 
    animation-name: zoom;
    animation-duration: 0.6s;
}
@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}
#image-viewer .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}
#image-viewer .close:hover,
#image-viewer .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
@section('content')
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
                                <input type="number" id="goalsetter" name="goalsetter" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
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
        <div id="mid-view" class="child-element" style="width:700px;margin-left:20%;margin-top:20px;">
            <div style="border-bottom:3px solid #98AE42;background:white;">  
                <div style="display:inline-block;vertical-align:top;border-radius:50%;">
                    <image id="profileImage" src="{{asset('profilepictures/'.$thrift->profile->picture)}}" style="width:150px;height:150px;border-radius: 50%;"><br>
                </div>
                <div style="display:inline-block;margin-left:5%;margin-top:5%;">
                    <h2>{{$thrift->details->fullname}}</h2>
                    <h5>{{$thrift->btitle}} - {{$thrift->bauthor}}</h5>
                    <p>Rating : {{$thrift->rating}}/5</p>
                </div> 
            </div>
            <br>
            <div style="background:white;"> 
                <content>
                <h5><b><u>My Review</u></b></h5><br>
                <p>{{$thrift->summary}}</p>
                <h5><b><u>Gallery</u></b></h5><br>
                <div class="images">&times;
                <img src="{{asset('coverpics/'.$thrift->frontcov)}}" width="70px" height="100px" style="margin-left:50px;" onclick="zoomImage()">
                <img src="{{asset('coverpics/'.$thrift->backcov)}}" width="70px" height="100px" style="margin-left:50px;" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->page1)}}"   width="70px" height="100px" style="margin-left:50px;" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->page2)}}"   width="70px" height="100px" style="margin-left:50px;" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->page3)}}"  width="70px" height="100px" style="margin-left:50px;" onclick="zoom()">
                </div>
                <div id="image-viewer">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="full-image">
                    </div>
                </content>
                <script>
                  $(".images img").click(function(){
                    $("#full-image").attr("src", $(this).attr("src"));
                    $('#image-viewer').show();
                    });

                    $("#image-viewer .close").click(function(){
                    $('#image-viewer').hide();
                    });

                </script>
                <br><br>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <b>Overview</b>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                        <table id="spec-book-tab">
                                            <tr>
                                                <td>Condition</td>
                                                <td>{{$thrift->bcondition}} </td>
                                            </tr>
                                            <tr>
                                                <td>Language</td>
                                                <td>{{$thrift->blanguage}} </td>
                                            </tr>
                                            <tr>
                                                <td>ISBN</td> 
                                                <td>{{$thrift->bisbn}} </td>
                                            </tr>
                                            <tr>
                                                <td>Format</td>
                                                <td> {{$thrift->format}} </td>
                                            </tr>
                                        </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div style="margin-left:50px;">
                <h5>Requests</h5><br>
                @if($thrift->userid== $user->userid)
                <table class="table" id="sales-tab" style="background-color:white;">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Requested By</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($thriftneg as $thriftneg)
                        <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$thriftneg->detail->fullname}}</td>
                        <td>{{$thriftneg->negoamt}}</td>
                        <td>
                        <a href="{{route('thriftreq', ['id' => $thriftneg->id, 'stat' => 2])}}"><span id="boot-icon" class="bi bi-check" style="font-size: 18px; color: rgb(0, 128, 55); -webkit-text-stroke-width: 0px;"></span></a>
                        <a href="{{route('thriftreq',['id' => $thriftneg->id, 'stat' => 0])}}"><span id="boot-icon" class="bi bi-x" style="font-size: 18px; color: rgb(255, 0, 0);"></span></a>
                        </td>
                        </tr>
                        @php($i=$i+1)
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <price><b>Place a bid any where not less than ₹{{$thrift->minprice}}</b></price>
                    <form action="{{route('negothrift',['sellerid'=>$thrift->userid,'storeid'=>$thrift->id])}}" method="POST">
                    @csrf
                        <!-- <negotiate style="margin-left:150px;"><b>Negotiate?</b> <input type="checkbox" name="yesnego" value="yes" onclick=negotiate() ></negotiate> -->
                        <input  type="number" id="neg" value="{{$thrift->minprice}}" min="{{$thrift->minprice}}" name="nego" onKeyDown="return false" style="margin-left:0px;">
                        <!-- <button type="submit" class="btn btn-primary" style="margin-left:30px;" formaction="{{route('negothrift',['sellerid'=>$thrift->userid,'storeid'=>$thrift->id])}}" > REQUEST </button> -->
                        <button type="submit" class="btn btn-success" style="margin-left:30px;" > BID </button>
                    </form>
                @endif
                    <script type="text/javascript">
                        function negotiate(){
                            var neg = document.getElementById('neg');
                            if(neg.disabled == true)
                                neg.disabled = false;
                            else
                                neg.disabled = true;
                        }

                        function zoom(){
                            var pic = document.getElementById('bp1');
                            if(pic.width=="70px" && pic.height=="100px"){
                                pic.width="170px";
                                pic.height="200px";
                            }
                            else{
                                pic.width="70px";
                                pic.height="100px";
                            }
                        }
                    </script>
                    <br><br>
                </div>
            </div>
        </div>
@endsection