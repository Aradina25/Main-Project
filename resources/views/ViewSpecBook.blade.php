<head>
    <title>{{$viewbook->title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('addash.css')}}">
    <script src="{{ asset('validation.js')}}"></script>
    <script src="{{ asset('jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                $('#edit-book').hide();
                // $('#searchbox').hide();
                $('#edit-btn').click(function(){
                    $('#edit-btn').hide();
                    //$('#update-book-btn').show();
                    $('#edit-book').show();
                    $('#view-spec-book').hide();
                });
                $('#back-btn').click(function(){
                    $('#view-spec-book').show();
                    $('#edit-book').hide();
                    $('#edit-btn').show();
                });
            });
    </script>
</head>
<body>
    <div id="sidebar">
        <ul>
                <li id="site-name"><p>BLOUNGE</p></li>
                <li><div class="row"><img src="{{ asset('images/adminavatar.png')}}" id="pro-pic" style="margin-left:10px">&nbsp&nbsp<a><p style="margin-top:20px">{{$user->fullname}}</p></a></div></li>
                <li  id="db"><a href="/adminDashboard">DASHBOARD</a></li>
                <li  id="book"><a href="/adbook">BOOK</a></li>
                <li  id="member"><a>MEMBERS</a></li>
                <li  id="order"><a>ORDERS</a></li>
                <li id="Logout" style="margin-top:80px"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
    <br><br><br>
    <div id="dashboard">
        <div id="view-spec-book">
            <div class="row">
                <h2>{{$viewbook->title}} - {{$viewbook->author}}</h2>
                <button id="edit-btn" style="margin-left: 50px;margin-top:20px;">EDIT</button>
                <button id="back-btn-i" style="margin-left: 10px;margin-top:20px;" onclick="location.href='/adbook'">BACK</button>
            </div>
            <table id="spec-book-tab">
                <tr>
                    <td rowspan="4"><img src="{{ asset('coverpics/'.$viewbook->cov_pic)}}" id="cov-pic"></td>
                    <td>Genre : {{$viewbook->genre}} </td>
                    <td>ISBN : {{$viewbook->ISBN}} </td>
                    <td>No.of pages : {{$viewbook->pages}} </td>
                </tr>
                <tr>
                    <td>Publisher : {{$viewbook->publisher}} </td>
                    <td>Language : {{$viewbook->language}} </td>
                    <td>Publish Date : {{$viewbook->publish_date}} </td>
                </tr>
                @foreach($stock as $stock)
                    <tr>
                        <td>{{$stock->type}}</td>
                        <td>Price {{$stock->price}}</td>
                        <td>Discount {{$stock->discount}}%</td>
                    </tr>
                @endforeach
                <tr>
                     <td colspan="4" id="spec-summary">{{$viewbook->summary}}</td>
                </tr>
            </table>
        </div>
        <div id="edit-book">
            <div class="row">
                <h3>EDIT BOOK</h3><br>
                <button id="back-btn" style="margin-left: 680px;">BACK</button>
            </div>
            <form action="{{route('editbook',$viewbook->accession_no)}}" method="POST" enctype="multipart/form-data">
                @if(Session('status'))
                    <span style="color:red">{{Session('status')}}</span>
                @endif
                @csrf
                <table id="add-book-tab">
                    <tr>
                        <td><label for="cp">Cover Picture <Picture></Picture></label></td>
                        <td><span id="errcp"></span><br><input type="file" id="cp" name="cov_pic" class="input-box" value="{{ asset('coverpics/'.$viewbook->cov_pic)}}" onchange="fileValidation()" required></td>
                    </tr>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><span id="titleerr"></span><input type="text" id="title" name="title" class="input-box" value="{{$viewbook->title}}" onkeyup="ValidateTitle()" required></td>
                    </tr>
                    <tr>
                        <td><label for="author">Author</label></td>
                        <td><span id="autherr"></span><input type="text" id="author" name="author" class="input-box" value="{{$viewbook->author}}" onkeyup="ValidateAuthor()" required></td>
                    </tr>
                    <tr>
                        <td><label for="genre">Genre</label></td>
                        <td><span id="generr"></span><input type="text" id="genre" name="genre" class="input-box" value="{{$viewbook->genre}}" onkeyup="ValidateGenre()" required></td>
                    </tr>
                    <tr>
                        <td><label for="summary">Summary</label></td>
                        <td><textarea id="summary" name="summary" rows="10" cols="108" required>{{$viewbook->summary}}</textarea></td>
                    </tr>
                    <tr>
                        <td><label for="pages">Pages</label></td>
                        <td><input type="number" id="pages" name="pages" class="input-box" value="{{$viewbook->pages}}" required></td>
                    </tr>
                    <tr>
                        <td><label for="lang">Language</label></td>
                        <td><span id="errlang"></span><input type="text" id="lang" name="language" class="input-box" value="{{$viewbook->language}}" onkeyup="ValidateLang()" required></td>
                    </tr>
                    <tr>
                        <td><label for="publisher">Publisher</label></td>
                        <td><span id="puberr"></span><input type="text" id="publisher" name="publisher" class="input-box" value="{{$viewbook->publisher}}" onkeyup="ValidatePub()" required></td>
                    </tr>
                    <tr>
                        <td><label for="publish-date">Publish Date</label></td>
                        <td><input type="date" id="publish-date" name="publish_date" class="input-box" value="{{$viewbook->publish_date}}" required></td>
                    </tr>
                    <tr>
                        <td><label for="ISBN">ISBN</label></td>
                        <td><span id="isbnerr"></span><input type="number" id="ISBN" name="ISBN" class="input-box" value="{{$viewbook->ISBN}}" onkeyup="ValidateISBN()" required></td>
                    </tr>
                    <tr> 
                        <td><label for="addbook">Action</label></td>
                        <td><input type="submit" id="addbook" name="editbook" value="EDIT" class="input-box"></td>
                    </tr>

                </table>                
            </form>
        </div>
    </div>
</body>