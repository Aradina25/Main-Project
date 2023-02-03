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
            <li style="margin-left:-5px;"><div class="row"><img src="{{asset('images/adminavatar.png')}}" id="pro-pic" style="margin-left:10px">&nbsp&nbsp<a><p style="margin-top:20px">{{$user->fullname}}</p></a></div></li>
            <li  id="db"><a href="/adminDashboard">DASHBOARD</a></li>
            <li  id="book"><a href="/adbook">BOOK</a></li>
            <li  id="author"><a href="/adauthor">AUTHOR</a></li>
            <li  id="member"><a href="#">MEMBERS</a></li>
            <li  id="order"><a>ORDERS</a></li>
            <li id="Logout"><a href="/logout">LOG OUT</a></li>
        </ul>
    </div>
    <div id="dashboard" style="margin-top:10px;"><br>
        <!-- <div class="row"> -->
        <h2>ORDER DETAILS</h2>
        <table id="view-order-tab">
            <thead>
                <tr>
                        <th>ORDERID</th>
                        <th>CUSTOMER</th>
                        <th>PLACED TIME</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                            <td></td>
                            <td>{{$odet->orderid}}</td>
                            <td>{{$odet->cust->fullname}}</td>
                            <td>{{$odet->placed_at}}</td>
                            <td>{{$odet->paymentamt}}</td>
                            @if($odet->status==0)
                            <td style="color:lightgreen">Completed</td>
                            @elseif($odet->status==1)
                            <td style="color:orange">Pending</td>
                            @else
                            <td style="color:cyan">Processing</td>
                            @endif
                    </tr>
            </tbody>
        </table>
        <h2>SHIPPING DETAILS</h2>
        <table id="view-order-tab">
            <thead>
                <tr>
                        <th>ORDERID</th>
                        <th>CUSTOMER</th>
                        <th>PLACED TIME</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                            <td></td>
                            <td>{{$odet->orderid}}</td>
                            <td>{{$odet->cust->fullname}}</td>
                            <td>{{$odet->placed_at}}</td>
                            <td>{{$odet->paymentamt}}</td>
                            @if($odet->status==0)
                            <td style="color:lightgreen">Completed</td>
                            @elseif($odet->status==1)
                            <td style="color:orange">Pending</td>
                            @else
                            <td style="color:cyan">Processing</td>
                            @endif
                    </tr>
            </tbody>
        </table>
        
    </div>

</body>