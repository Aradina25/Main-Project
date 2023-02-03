@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title','Search results for '.$s)
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)
@section('tbr',count($tbr))
@section('curr',count($curr))
@section('done',count($done))
<head>
   <style>

        #mini-cov-pic{
            width:50px;
            height:70px;
        }

        #dashboard #view-book-tab{
            border-collapse: collapse;
            /* width:600px; */
        }

        #dashboard #view-book-tab td{
            padding: 10px;
        }

        #spec-book-tab td{
            padding:50px;
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
    <div id="mid-view" class="child-element">
        <table id="view-book-tab">
            <tbody>
                @if(count($search)>0)
                    @foreach($search as $book)
                    <tr>
                        <td rowspan="2"><img src="{{ asset('coverpics/'.$book->cov_pic)}}" id="mini-cov-pic"></td>
                        <td colspan="3"><b>{{$book->title}} - {{$book->author}}</b></td>
                    </tr>
                    <tr>
                        <td>{{$book->genre}} -
                            @if($book->lib->status==1)
                                <i><span style="color:blue">To Be Read</span></i>
                            @elseif($book->lib->status==2)
                                <i><span style="color:blue">Current Read</span></i>
                            @else
                                <i><span style="color:blue">Completed</span></i>
                            @endif
                        </td>
                        <form action="{{route('memviewbook',$book->accession_no)}}" method="POST">
                        @csrf
                        <td><button type="submit" class="btn btn-primary">MORE</button></td>
                        </form>
                        <td><div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:150px;">
                        Save to Library
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('markbook',['accId'=>$book->accession_no,'stat'=>1])}}">Want to Read</a>
                        <a class="dropdown-item" href="{{route('markbook',['accId'=>$book->accession_no,'stat'=>2])}}">Currently Reading</a>
                        <a class="dropdown-item" href="{{route('markbook',['accId'=>$book->accession_no,'stat'=>3])}}">Read</a>
                    </div>
                </div>
            </div></td>
                    </tr>
                    @endforeach
                @endif
                @if(count($searchp)>0)
                    @foreach($searchp as $user)
                            @if(count($follow)>0)
                                @foreach($follow as $follow)
                                    @if($follow->friendid == $user->userid)
                                        @php($button = "Unfollow")
                                    @else
                                        @php($button = "Follow")
                                    @endif
                                @endforeach
                            @else
                                @php($button = "Follow")
                            @endif
                            <tr>
                                <td rowspan="2"><img src="{{ asset('profilepictures/'.$user->pics->picture)}}" style="border-radius:50%;width:100px;height:100px;"></td>
                                <td colspan="3"><b>{{$user->fullname}} - Level {{$user->pics->level}} </b></td>
                            </tr>
                        <tr>
                            <td>{{$user->pics->bio}}</td>
                            <form action="{{route('follow',$user->userid)}}" method="POST">
                            @csrf
                            <td><button type="submit" class="btn btn-outline-success" name="follow" id="follow">{{$button}}</button>
                            </form>
                            </div></td>
                        </tr>
                        
                    @endforeach
                @endif
                
            </tbody>
        </table>
    </div>
        
</div>
@endsection