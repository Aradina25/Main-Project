@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title',$thrift->btitle)
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)
<style>
    .bookpics{
        margin-left:50px;
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
                <img src="{{asset('coverpics/'.$thrift->frontcov)}}" class="bookpics" class="bp1" width="70px" height="100px" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->backcov)}}" class="bookpics" width="70px" height="100px" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->page1)}}" class="bookpics" width="70px" height="100px" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->page2)}}" class="bookpics" width="70px" height="100px" onclick="zoom()">
                <img src="{{asset('coverpics/'.$thrift->page3)}}" class="bookpics" width="70px" height="100px" onclick="zoom()">
                </content>
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
                    <price><b>Price : ₹{{$thrift->maxprice}}</b></price>
                    <form action="{{route('buythrift',['sellerid'=>$thrift->userid,'storeid'=>$thrift->id])}}" method="POST">
                    @csrf
                        <negotiate style="margin-left:150px;"><b>Negotiate?</b> <input type="checkbox" name="yesnego" value="yes" onclick=negotiate() ></negotiate>
                        <input  type="number" id="neg" value="{{$thrift->maxprice}}" min="{{$thrift->minprice}}" max="{{$thrift->maxprice}}" name="nego" onKeyDown="return false" style="margin-left:20px;" disabled>
                        <button type="submit" class="btn btn-primary" style="margin-left:30px;" formaction="{{route('negothrift',['sellerid'=>$thrift->userid,'storeid'=>$thrift->id])}}" > REQUEST </button>
                        <button type="submit" class="btn btn-success" style="margin-left:30px;" > BUY </button>
                    </form>
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