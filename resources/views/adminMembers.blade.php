<head>
    <title>adminDasboard</title>
    <link rel="stylesheet" type="text/css" href="{{asset('addash.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
    </script>
    <style>
        body{
            font-family: cursive;
            background-color:rgba(6, 6, 6, 0.797);
        }
    </style>

</head>
<body>
        <div id="sidebar">
            <ul>
                <li id="site-name"><p>BLOUNGE</p></li>
                <li style="margin-left:-5px;"><div class="row"><img src="images/adminavatar.png" id="pro-pic" style="margin-left:10px">&nbsp&nbsp<a><p style="margin-top:20px">{{$user->fullname}}</p></a></div></li>
                <li  id="db"><a href="/adminDashboard">DASHBOARD</a></li>
                <li  id="book"><a href="/adbook">BOOK</a></li>
                <li  id="member"><a href="#">MEMBERS</a></li>
                <li  id="order"><a>ORDERS</a></li>
                <li id="Logout"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
        <div id="dashboard" style="margin-top:50px;"><br>
            <h2>MEMBER MANAGEMENT</h2>
            <table id="view-book-tab">
                    <thead>
                    <tr>
                        <th>SL.NO</th>
                        <th>@sortablelink('fullname','NAME')</th>
                        <th>@sortablelink('dob','DOB')</th>
                        <th>@sortablelink('age','AGE')</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($mem1 as $member)
                        <tr>
                            <td></td>
                            <td>{{$member->fullname}}</td>
                            <td>{{$member->dob}}</td>
                            <td>{{$member->age}}</td>
                            <form action="{{route('admempro',$member->userid)}}" method="POST">
                                @csrf
                                <td><button type="submit">VIEW</button></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>

</body>