@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title','HOME')
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)


<style>
    body{
            background-image: url("images/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    #post-module{
        margin-left:100px;
        margin-top:100px;
        height:220px;
        width:600px;
        border: 2px solid whitesmoke;
        box-shadow: 5px 5px whitesmoke;
        border-radius: 5px;
        background:white;
    }
    .posts{
        width:600px;
    }
    .posts .post{
        margin-left:100px;
        margin-top:50px;
        padding-left:10px;
        border-left:3px solid #a21b24;
    }

    .posts .post .info{
        color: #aaa;
        font-style: italic;
    }
    #post-module #whats-on-mind{
        margin-top:10px;
        margin-left:10px;
        width:570px;
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
    #post-module #upload-icon{
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
</style>
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
        <div class="modal fade" id="addyourstoremodal" tabindex="-1" role="dialog" aria-labelledby="addyourstoremodalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-100 w-50" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addyourstoremodalTitle">Add to your store</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/addtostore" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Add Cover Picture</th>
                        <td><span id="errcp"></span><br><input type="file" id="cp" name="bcov_pic" class="input-box" onchange="fileValidation()" required></td>
                    </tr>
                    <tr>
                        <th scope="row">Add BackCover </th>
                        <td><span id="errbc"></span><br><input type="file" id="bc" name="back_pic" class="input-box" onchange="fileValidation()" required></td>
                    </tr>
                </tbody>
                </table>
                <table class="table">
                <tbody>
                    <tr>
                        <th scope="row" rowspan="4" style="vertical-align : middle;text-align:center;">Add picture of 3 pages to show<br> the condition of the book</th>
                    </tr>                   
                        <tr>                        
                            <td><span id="errbc"></span><br><input type="file" id="page1" name="page1" class="input-box" onchange="fileValidation()" required></td>
                        </tr>
                        <tr>                        
                            <td><span id="errbc"></span><br><input type="file" id="page2" name="page2" class="input-box" onchange="fileValidation()" required></td>
                        </tr>
                        <tr>                        
                            <td><span id="errbc"></span><br><input type="file" id="page3" name="page3" class="input-box" onchange="fileValidation()" required></td>
                        </tr>
                        
                </tbody>
                </table>
                <p><b>Add Overview</b></p>
                <table class="table">
                <tbody>
                    <tr>
                        <td>Condition</td>
                        <td>
                            <select id="condition" name="condition">
                                <option>Good</option>
                                <option>Print bit faded</option>
                                <option>Bends on cover</option>
                                <option>Readable</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                            <td>Title</td>
                            <td><span id="errtitle"></span><input type="text" id="title" name="btitle" class="input-box" onkeyup="ValidateTitle()" required></td>
                    </tr>
                    <tr>
                            <td>Author</td>
                            <td><span id="autherr"></span><input type="text" id="author" name="bauthor" class="input-box" onkeyup="ValidateAuthor()" required></td>
                    </tr>
                    <tr>
                            <td>Language</td>
                            <td><span id="errlang"></span><input type="text" id="lang" name="blanguage" class="input-box" onkeyup="ValidateLang()" required></td>
                        </tr>
                        <tr>
                            <td>ISBN</td>
                            <td><span id="isbnerr"></span><input type="number" id="ISBN" name="bISBN" class="input-box" onkeyup="ValidateISBN()" required></td>

                        </tr>
                        <tr>
                            <td>Format</td>
                            <td><span id="errformat"></span><input type="text" id="format" name="bformat" class="input-box" onkeyup="ValidateLang()" required></td>
                        </tr>
                        <tr>
                            <td><label for="summary">Summary</label></td>
                            <td><textarea id="summary" name="summary" rows="5" cols="30" required></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="Rating">Rating</label></td>
                            <td><span id="rating"></span><input type="number" id="rating" name="rating" max="5" min="1" class="input-box" onkeyup="ValidateHardcover()" required></td>
                        </tr>
                        <tr>
                            <td><label for="price">Price</label></td>
                            <td><span id="harderr"></span><input type="number" id="price" name="price" class="input-box" onkeyup="ValidateHardcover()" required></td>
                        </tr>
                        <tr>
                            <td><label for="minprice">Minimum Price</label></td>
                            <td><span id="minerr"></span><input type="number" id="minprice" name="minprice" class="input-box" onkeyup="ValidateminHardcover()" required></td>
                        </tr>
                </tbody>
                </table>                       
            </table>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add More to Library</button>
                </div>
                </div>
            </div>
        </div>
<div id="mid-view" class="child-element" style="width:750px;">
    <div id="post-module">
        <form action="/postUpload" method="POST" enctype="multipart/form-data"> 
        @csrf
            <textarea id="whats-on-mind" name="wom" placeholder="Whats on your mind...." ></textarea><br>
                <label for="file-input">
                <span id="errcp"></span><br><img src="images/post.png" name="upload-icon" id="upload" style="width:50px; height:50px;" >
                <input type="file" id="file-input" name="postimage" onchange="fileValidation()">
                </label>
                <button type="submit" class="btn btn-primary" id="upload-btn">UPLOAD</button>
        </form>
    </div>
    <section class="row posts">
        <!-- <div class="col-md-6 col-md-offset-3"> -->
        @foreach($followpost as $posts)
            <article class="post">
                <div class="card mb-3" style="max-width: 780px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <image id="posts" src="{{ asset('posts/'.$posts->image)}}" style="width:150px;height:100%;"><br>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <!-- <li class="icons dropdown"> -->
                                <br>
                                <p class="card-text">{{$posts->body}}</p>
                                <p class="card-text"><small class="text-muted">{{$posts->details->fullname}} posted this on {{$posts->created_at}}</small></p>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div>
                    <img src="images/like.png" id="img" style="width:25px;height:25px;" onclick="like()">
                    <script>
                        function like(){
                            var img = document.getElementById("img");
                            if(img.src.match("images/like.png"))
                                img.src="images/like2.jpg"
                            else
                                img.src = "images/like.png"
                        }
                    </script>
                    <img src="images/comment.png" style="width:25px;height:25px;margin-left:30px;">
                    <img src="images/share.png" style="width:25px;height:25px;margin-left:30px;">
                    <!-- <img src="images/unsave.webp" style="width:25px;height:25px;margin-left:500px;"> -->
                </div>
            </article>
        @endforeach   
        <!-- </div> -->
    </section>
</div>
<div id="storead" class="child-element" style="margin-top:30px;">
    <p><b>Buy from us</b></p>
    <table id="view-book-tab" style="margin-top:30px;">
    <tr>
        <td><img src="{{asset('coverpics/1660043075cp.jpg')}}" style="width:80px;height:100px;"></td>
        <td><img src="{{asset('coverpics/1660062815cp.jpg')}}" style="width:80px;height:100px;"></td>
    </tr>
    <tr>
        <td><img src="{{asset('coverpics/1660063434cp.jpg')}}" style="width:80px;height:100px;"></td>
        <td><img src="{{asset('coverpics/1660117095cp.jpg')}}" style="width:80px;height:100px;"></td>
    </tr>
    <tr>
        <td><img src="{{asset('coverpics/1663776805cp.jpg')}}" style="width:80px;height:100px;"></td>
        <td><img src="{{asset('coverpics/1666623089cp.jpg')}}" style="width:80px;height:100px;"></td>
    </tr>
    </table>
</div>

@endsection