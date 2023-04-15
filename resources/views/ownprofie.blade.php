@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title','HOME')
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)
@section('picture',$profile->picture)

<style>
     
    article{
        border-left:3px solid #a21b24;
    }
    .info{
        color: #aaa;
        font-style: italic;
    }
    

    #whats-on-mind{
        margin-top:10px;
        margin-left:10px;
        width:470px;
        height:120px;
        border:none;
    }

    #whats-on-mind{
        overflow: auto;
        outline: none;

        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;

        resize: none;
    }
    #upload-icon{
        border:1px solid black;
    }

    #file-input{
        display:none;
    }
    #upload{
        margin-top:20px;
    }
    #upload-btn{
        margin-top:20px;
    }
    /* #addyourstoremodal{
        
    max-width: 80%;
    } */
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
                                @if(Session::has('ming'))
                                <div class="alert alert-danger" role="alert">{{Session::get('ming')}}</div>
                                @endif
                                <input type="number" id="goalsetter" name="goalsetter" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                <button type="submit" class="btn btn-primary">Set</button>
                            </form>
                        @else
                        <div class="book-list">
                            <h6>Completed Books</h6>
                            <tr>
                            @foreach($librarycheck as $book)
                                <td><a href="{{route('memviewbook',$book->accession_no)}}"><img src="{{asset('coverpics/'.$book->products->cov_pic)}}" alt="{{$book->products->title}}" style="width:50px;height:60px;"></a></td>
                            @endforeach
                            </tr>
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
                        <h6> Currently on store </h6>
                        <tr>
                        @foreach($tobesold as $t)
                        <td><a href=""><img src="{{asset('coverpics/'.$t->frontcov)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <br>
                        <h6> Sold  </h6>
                        <tr>
                        @foreach($soldbooks as $s)
                        <td><a href=""><img src="{{asset('coverpics/'.$s->frontcov)}}" alt="" style="width:50px;height:60px;"></a></td>
                        @endforeach
                        </tr>
                        <br>
                        <br>
                        <h6><a href="/currsale">Click to view current sales</a></h6>
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
        <div style="border-bottom:3px solid #98AE42;background:white;height:170px;">  
            <div style="float:left;vertical-align:top;border-radius:50%;margin-top:10px;">
                <image id="profileImage" src="{{ asset('profilepictures/'.$profile->picture)}}" style="width:150px;height:150px;border-radius: 50%;"><br>
            </div>
            <div style="margin-left:5%;margin-top:10px;">
                <h2>{{$user->fullname}}</h2>
                <h5>{{$profile->bio}}</h5>
                <p style="float:left;"><b>Level : {{$profile->level}}</b></p>
                <p style="margin-left:200px;"><b>Reward coins available : {{$profile->coins}}</b></p>
            </div>      
        </div>  
            @if(count($posts)>0)
            <h3 style="margin-top:5%;">Your Posts</h3><br>
            @foreach($posts as $posts)
            @php($postid = $posts->postid)
            <article class="post">
                <div class="card mb-3" style="max-width: 700px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <image id="posts" src="{{ asset('posts/'.$posts->image)}}" style="width:150px;height:100%;"><br>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <!-- <li class="icons dropdown"> -->
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown" style="margin-left:400px;">
                                <span class="activity active"></span>
                                <img src="{{ asset('images/threedots.jpg')}}" height="20" width="40" alt="options">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        @if($posts->status == 1)
                                        <li><a data-id="{{$postid}}" data-toggle="modal" data-target="#editposts" class="editposts" style="color:black;cursor:pointer" >Edit</a></li>
                                        @endif
                                        <li><a href="{{route('deletepost',$postid)}}" style="color:black;cursor:pointer">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                                <br>
                                <p class="card-text">{{$posts->body}}</p>
                                <p class="card-text"><small class="text-muted">You posted this on {{$posts->created_at}}</small></p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach 
        @endif  
        </div>
        <div class="modal fade" id="editposts" tabindex="-1" role="dialog" aria-labelledby="editpostsTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editpostsTitle">EDIT POST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>
                <div class="modal-body">
                <form action="/editposts" method="POST" enctype="multipart/form-data"> 
                @csrf
                    <textarea id="whats-on-mind" name="editwom" placeholder="Whats on your mind...." ></textarea><br>
                    <label for="file-input">
                    <span id="errcp"></span><br><img src="images/post.png" name="upload-icon" id="upload" style="width:50px; height:50px;" >
                    <input type="file" id="file-input" name="editimage" onchange="fileValidation()">
                    </label>
                    <!-- <input type="text" id="id" name="id" value="{{}}"> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">UPLOAD</button>
                    </form>  
                </div>
                </div>
            </div>
        </div> 

        
@endsection