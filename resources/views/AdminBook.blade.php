<head>
    <title>Book Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('addash.css')}}">
    <script src="{{asset('validation.js')}}"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                // location.reload(true);
                $('#add-book').hide();
                $('#add-stock').hide();
                // $('#searchbox').hide();
                $('#add-book-btn').click(function(){
                    $('#add-book-btn').hide();
                    $('#add-stock-btn').hide();
                    $('#view-book-btn').show();
                    $('#add-book').show();
                    $('#view-book').hide();
                });
                $('#add-stock-btn').click(function(){
                    $('#add-book-btn').hide();
                    $('#add-stock-btn').hide();
                    $('#view-book-btn').show();
                    $('#add-stock').show();
                    $('#view-book').hide();
                });
                $('#view-book-btn').click(function(){
                    $('#add-book-btn').show();
                    $('#add-stock-btn').show();
                    $('#view-book-btn').hide();
                    $('#add-book').hide();
                    $('#add-stock').hide();
                    $('#view-book').show();
                });
                
            });
    </script>
</head>
<body>
    <div id="sidebar">
            <ul>
                <li id="site-name"><p>BLOUNGE</p></li>
                <li style="margin-left:-5px;"><div class="row"><img src="images/adminavatar.png" id="pro-pic" style="margin-left:10px">&nbsp&nbsp<a><p style="margin-top:20px">{{$user->fullname}}</p></a></div></li>
                <li  id="db"><a href="/adminDashboard">DASHBOARD</a></li>
                <li  id="book"><a href="/adbook">BOOK</a></li>
                <li  id="author"><a href="/adauthor">AUTHOR</a></li>
                <li  id="member"><a href="/admembers">MEMBERS</a></li>
                <li  id="order"><a>ORDERS</a></li>
                <li id="Logout"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
    <br><br><br>
    <div id="dashboard">
        <h2> BOOK MANAGEMENT</h2>
        <button id="add-book-btn">ADD BOOK</button>
        <button id="add-stock-btn">ADD STOCK</button>
        <div id="add-book">
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
                        <td><span id="errcp"></span><br><input type="file" id="cp" name="cov_pic" class="input-box" onchange="fileValidation()" required></td>
                    </tr>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><span id="titleerr"></span><input type="text" id="title" name="title" class="input-box" onkeyup="ValidateTitle()" required></td>
                    </tr>
                    <tr>
                        <td><label for="author">Author</label></td>
                        <td><span id="autherr"></span><input type="text" id="author" name="author" class="input-box" onkeyup="ValidateAuthor()" required></td>
                    </tr>
                    <tr>
                        <td><label for="genre">Genre</label></td>
                        <td><span id="generr"></span><input type="text" id="genre" name="genre" class="input-box" onkeyup="ValidateGenre()" required></td>
                    </tr>
                    <tr>
                        <td><label for="summary">Summary</label></td>
                        <td><textarea id="summary" name="summary" rows="10" cols="108" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="pages">Pages</label></td>
                        <td><input type="number" id="pages" name="pages" class="input-box" min="1" required></td>
                    </tr>
                    <tr>
                        <td><label for="lang">Language</label></td>
                        <td><span id="errlang"></span><input type="text" id="lang" name="language" class="input-box" onkeyup="ValidateLang()" required></td>
                    </tr>
                    <tr>
                        <td><label for="publisher">Publisher</label></td>
                        <td><span id="puberr"></span><input type="text" id="publisher" name="publisher" class="input-box" onkeyup="ValidatePub()" required></td>
                    </tr>
                    <tr>
                        <td><label for="publish-date">Publish Date</label></td>
                        <td><input type="date" id="publish-date" name="publish_date" class="input-box" max="{{date('Y-m-d')}}" required></td>
                    </tr>
                    <tr>
                        <td><label for="ISBN">ISBN</label></td>
                        <td><span id="isbnerr"></span><input type="number" id="ISBN" name="ISBN" class="input-box" onkeyup="ValidateISBN()" required></td>
                    </tr>
                    <tr>
                        <td><label for="addbook">Action</label></td>
                        <td><input type="submit" id="addbook" name="addbook" value="ADD" class="input-box"></td>
                    </tr>
                </table>                
            </form>
        </div> 
        <div id="add-stock">
            <div class="row">
                <h3>ADD STOCK</h3><br>
                <button id="back-btn-i" style="margin-left: 650px;margin-top:20px;" onclick="location.href='/adbook'">BACK</button>
                 
            </div>
            <form action="/addstock" method="POST" enctype="multipart/form-data">
            @if(Session('status'))
                <span style="color:red">{{Session('status')}}</span>
            @endif
            @csrf
                <table id="add-book-tab">
                    <tr>
                        <td><label for="title">Select the book to be added</label></td>
                        <td><select name="booktitle" id="booktitle" class="input-box">
                            @foreach($book as $book)
                            <option>{{$book->title}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="type">Type of book</label></td>
                        <td><select name="type" id="type" class="input-box">
                            <option>Hardcover</option>
                            <option>Paperback</option>
                            <option>EBook</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="price">Price</label></td>
                        <td><span id="harderr"></span><input type="number" id="price" name="price" class="input-box" onkeyup="ValidateHardcover()" required></td>
                    </tr>
                    <tr>
                        <td><label for="discount">Discount</label></td>
                        <td><span id="disharderr"></span><input type="number" id="discount" name="discount" class="input-box" onkeyup="ValidateDiscountHardcover()" required></td>
                    </tr>
                    <tr>
                        <td><label for="qty">Quantity</label></td>
                        <td><span id="qerr"></span><input type="number" id="qty" name="qty" class="input-box" required></td>
                    </tr>
                    <tr>
                        <td><label for="addbook">Action</label></td>
                        <td><input type="submit" id="addbook" name="addstock" value="ADD" class="input-box" style="background"></td>
                    </tr>
                </table>                
            </form>
        </div>

        <div id="view-book">
                <h4>BOOK DETAILS</h4>
                <form action="/searchbook" method="POST">
                @csrf
                    <label for="search"></label>
                    <input id="search" name="search" placeholder="Enter title,author or genre">
                    <button type="submit">SEARCH</button>
                </form>
                @if(Session('status'))
                        <span style="color:red">{{Session('status')}}</span>
                @endif
                <br>
                <table id="view-book-tab">
                    <thead>
                    <tr>
                        <th>SL.NO</th>
                        <th>@sortablelink('title','TITLE')</th>
                        <th>@sortablelink('author','AUTHOR')</th>
                        <th>@sortablelink('genre','GENRE')</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($search)>0)
                        @foreach($search as $book)
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
                    @else
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
                    @endif
                    </tbody>
                </table>
        </div>
    </div>
</body>