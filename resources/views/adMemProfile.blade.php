
<head>
    <title>MEMBER MANAGEMENT</title>
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
        .alert {
            padding: 20px;
            background-color: orange;
            color: black;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>

</head>
<body>
        <div id="sidebar">
            <ul>
                <li id="site-name"><p>BLOUNGE</p></li>
                <li style="margin-left:-5px;"><div class="row"><img src="{{asset('images/adminavatar.png')}}" id="pro-pic" style="margin-left:10px">&nbsp&nbsp<a><p style="margin-top:20px">{{$user->fullname}}</p></a></div></li>
                <li  id="db"><a href="/adminDashboard">DASHBOARD</a></li>
                <li  id="book"><a href="/adbook">BOOK</a></li>
                <li  id="member"><a href="#">MEMBERS</a></li>
                <li  id="order"><a>ORDERS</a></li>
                <li id="Logout"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
    <div id="dashboard" style="margin-top:10px;"><br>
    <div class="row">
    <h2>MEMBER MANAGEMENT</h2>
    <form action="{{route('blck',['id'=>$Id,'role'=>3])}}" method="POST">
    @csrf
    @if($memreg->status ==3)
        <button type="submit" style="background-color:darkorange;margin-left:300px;margin-top:20px;">UNSUSPEND</button>
        @else
        <button type="submit" style="background-color:darkorange;margin-left:300px;margin-top:20px;">SUSPEND</button>
    @endif
    </form>
    
    <form action="{{route('blck',['id'=>$Id,'role'=>0])}}" method="POST">
    @csrf
    @if($memreg->status==2)
        <button type="submit" style="background-color:red;margin-left:10px;margin-top:20px;">BLOCK</button>
    @else
        <button type="submit" style="background-color:green;margin-left:10px;margin-top:20px;">UNBLOCK</button>
    @endif
    </form>
    <button id="back-btn-i" style="margin-left:10px;margin-top:20px;" onclick="location.href='/admembers'">BACK</button><br>

    </div>
    @if(Session('error'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Warning! </strong>{{Session('error')}}
    </div>
    @endif
    <br><br>
    <table id="pro-tab">
        <tr><td colspan="5"><b>PROFILE</b></td></tr>
        <tr>
            <td>Name </td>
            <td>{{$memreg->fullname}}</td>
            <td rowspan="9"><image id="profileImage" src="{{ asset('profilepictures/'.$memprop->picture)}}" style="width:150px;height:150px;"><br></td>
        </tr>
        <tr>
            <td>DOB </td>
            <td>{{$memreg->dob}}</td>
        </tr>
        <tr>
            <td>Age</td>
            <td>{{$memreg->age}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$memlog->email}}</td>
        </tr>
        <tr>
            <td>Bio</td>
            <td>{{$memprop->bio}}</td>
        </tr>
        <tr>
            <td>Level</td>
            <td>{{$memprop->level}}</td>
        </tr>
        <tr>
            <td>Reports</td>
            <td>{{$memreg->reports}}</td>
        </tr>
        <tr>
            <td>Suspend</td>
            <td>{{$memsus->suspend}}</td>
        </tr>
        <tr>
            <td>Status</td>
            @if($memreg->status == 0)
                <td style="color:red;"> Blocked </td>
            @elseif($memreg->status == 2)
                <td style="color:lightgreen;"> Active </td>
            @else
                <td style="color:orange;"> Suspended </td>
            @endif
        </tr>
    </table><br><br>
    <table id="pro-tab">
        <tr>
            <th colspan="2">FOLLOWERS</th>
        </tr>
        @if(count($memfrnd) > 0)
        @foreach($memfrnd as $f)
        <tr>
            <td>{{$f->frnd->fullname}}</td>
            <form action="{{route('admempro',$f->friendid)}}" method="POST">
            @csrf
                <td><button type="submit">VIEW</button></td>
            </form>
        </tr>
        @endforeach
        @else
        <tr>
            <td><center><span style="color:red"><b>NONE</b></span></center></td>
        </tr>
        @endif
    </table><br><br>
    <table id="pro-tab">
        <tr>
            <th colspan="4">ORDERS</th>
        </tr>
        <tr>
            <th>Order ID</th>
            <th>Amount</th>
            <th>PLACED TIME</th>
            <th>Status</th>
        </tr>
        @if(count($memorders) > 0)
        @foreach($memorders as $o)
        <tr>
            <td>{{$o->orderid}}</td>
            <td>{{$o->paymentamt}}</td>
            <td>{{$o->placed_at}}</td>
            @if($o->status==0)
            <td style="color:lightgreen">Completed</td>
            @elseif($o->status==1)
            <td style="color:orange">Pending</td>
            @else
            <td style="color:cyan">Processing</td>
            @endif
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4"><center><span style="color:red"><b>NONE</b></span></center></td>
        </tr>
        @endif
    </table><br><br>
    <table id="pro-tab">
        <tr>
            <th colspan="7">POSTS</th>
        </tr>
        <tr>
            <th>Pic</th>
            <th>Caption</th>
            <th style="width:100px;">Upload Time</th>
            <th>Likes</th>
            <th>Comments</th>
            <th>Reports</th>
            <th>Action</th>
        </tr>
        @foreach($mempost as $p)
        <tr>
            <td><image id="posts" src="{{ asset('posts/'.$p->image)}}" style="width:100px;height:150px;"><br</td>
            <td>{{$p->body}}</td>
            <td>{{$p->created_at}}</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td><button type="submit" style="background-color:red">DELETE</button></td>
        </tr>
        @endforeach
    </table><br><br>
    </div>
</body>