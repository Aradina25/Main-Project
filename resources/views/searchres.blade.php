<head>
    <title>Book Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('addash.css')}}">
    <script src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                // location.reload(true);
                $('#add-book').hide();
                // $('#searchbox').hide();
                $('#add-book-btn').click(function(){
                    $('#add-book-btn').hide();
                    $('#view-book-btn').show();
                    $('#add-book').show();
                    $('#view-book').hide();
                });
                $('#view-book-btn').click(function(){
                    $('#add-book-btn').show();
                    $('#view-book-btn').hide();
                    $('#add-book').hide();
                    $('#view-book').show();
                });
            });
    </script>
</head>
<body>
    <div id="sidebar">
            <ul>
                <li id="site-name"><p>BLOUNGE</p></li>
                <li><div class="row"><img src="images/adminavatar.png" id="pro-pic" style="margin-left:10px">&nbsp&nbsp<a><p style="margin-top:20px">{{$user->fullname}}</p></a></div></li>
                <li  id="db"><a href="/adminDashboard">DASHBOARD</a></li>
                <li  id="book"><a href="/adbook">BOOK</a></li>
                <li  id="member"><a>MEMBERS</a></li>
                <li  id="order"><a>ORDERS</a></li>
                <li id="Logout" style="margin-top:80px"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
    <br><br><br>
    <div id="dashboard">
        <h2> BOOK MANAGEMENT</h2>
        <!-- <button id="add-book-btn">ADD BOOK</button> -->
        <!-- <div id="add-book">
            <div class="row">
                <h3>ADD BOOK</h3><br>
                <button id="view-book-btn" style="margin-left: 680px;">VIEW BOOK</button>
            </div>
            <form action="/addbook" method="POST" enctype="multipart/form-data">
            @if(Session('status'))
                <span style="color:red">{{Session('status')}}</span>
            @endif
            @csrf
                <table id="add-book-tab">
                    <tr>
                        <td><label for="cp">Cover Picture <Picture></Picture></label></td>
                        <td><input type="file" id="cp" name="cov_pic" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><input type="text" id="title" name="title" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="author">Author</label></td>
                        <td><input type="text" id="author" name="author" class="input-box"  required></td>
                    </tr>
                    <tr>
                        <td><label for="genre">Genre</label></td>
                        <td><input type="text" id="genre" name="genre" class="input-box"  required></td>
                    </tr>
                    <tr>
                        <td><label for="summary">Summary</label></td>
                        <td><textarea id="summary" name="summary" rows="10" cols="108" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="pages">Pages</label></td>
                        <td><input type="number" id="pages" name="pages" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="lang">Language</label></td>
                        <td><input type="text" id="lang" name="language" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="publisher">Publisher</label></td>
                        <td><input type="text" id="publisher" name="publisher" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="publish-date">Publish Date</label></td>
                        <td><input type="date" id="publish-date" name="publish_date" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="ISBN">ISBN</label></td>
                        <td><input type="number" id="ISBN" name="ISBN" class="input-box" pattern="/^[1-9][0-9]{13}/" required></td>
                    </tr>
                    <tr>
                        <td><label for="addbook">Action</label></td>
                        <td><input type="submit" id="addbook" name="addbook" value="ADD" class="input-box"></td>
                    </tr>
                </table>                
            </form>
        </div> -->

        <div id="view-book">
                <h4>BOOK DETAILS</h4>
                <form action="/searchbook" method="POST">
                @csrf
                    <label for="search"></label>
                    <input id="search" name="search" placeholder="Enter title,author or genre">
                    <button type="submit">SEARCH</button>
                </form><br>
                <table id="view-book-tab">
                <thead>
                <tr>
                    <th>SL.NO</th>
                    <th>TITLE</th>
                    <th>AUTHOR</th>
                    <th>GENRE</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookdetails as $book)
                <tr>
                    <td></td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->genre}}</td>
                    <form action="{{route('viewbook',$book->accession_no)}}" method="POST">
                    @csrf
                    <td><button type="submit">VIEW</button></td>
                    </form>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>