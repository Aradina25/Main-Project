@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title',"profile")
@section('username',$user->fullname)
<script type="text/javascript">
  function fileValidation(){
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];  
    var fileInput = document.getElementById('cp');
    var filePath = fileInput.value;
    // var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (filePath.length > 0) {
        var flValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
            var sCurExtension = _validFileExtensions[j];
            if (filePath.substr(filePath.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                flValid = true;
                document.getElementById("errcp").innerHTML="";
                break;
            }
        
        }
        if(!flValid){
            document.getElementById("errcp").innerHTML='Please upload file having extensions .jpeg/.jpg/.png only.';
            fileInput.value = '';
            document.getElementById("addbook").disabled = true;
        }
    }
}
</script>
<style>
  #mid-view{
            flex-wrap:wrap;
            margin-left:15%;
            width:800px;

            /* border:1px solid black; */
        }

  #profileImage{
      width:100px;
      height:100px;
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
<div id="mid-view" class="child-element" style="margin-top:1%;">
<div id="profile-container" style="height:100%;position:fixed;margin-top:4%;">
   <image id="profileImage" src="{{ asset('profilepictures/'.$profile->picture)}}" />
</div>
<span style="color:red;"id="errcp"></span><input type="file" id="cp" name="cov_pic" class="input-box" onchange="fileValidation()" required="" style="margin-top:13%;height:100%;position:fixed;" capture><br><br>
  <div class="col-lg-8" style="margin-left:25%;">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Full Name</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{$user->fullname}}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">DOB</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{$user->dob}}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Age</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{$user->age}}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Email</p>
          </div>
          <div class="col-sm-9">
            <p class="text-muted mb-0">{{$data->email}}</p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <p class="mb-0">Password</p>
          </div>
          <div class="col-sm-9">
            <a href="/forgotpass">Change Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection