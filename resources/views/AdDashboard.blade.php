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
                <li  id="member"><a href="/admembers">MEMBERS</a></li>
                <li  id="order"><a href="/adorders">ORDERS</a></li>
                <li id="Logout"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
        <div id="dashboard"><br>
            <br><br><h2>DASHBOARD</h2><br>
                   
                    <div id="box1" class="dash-box">
                        <img src="images/images.png" height="30px" width="30px"><br><br>
                        <table id="view-book-tab">
                    <thead>
                    <tr>
                        <th colspan="7">ORDERS</th>
                    </tr>
                    <tr>
                        <th>SL.NO</th>
                        <th>ORDERID</th>
                        <th>CUSTOMER</th>
                        <th>ADDRESS</th>
                        <th>PLACED TIME</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $o)
                        <tr>
                            <td></td>
                            <td>{{$o->orderid}}</td>
                            <td>{{$o->cust->fullname}}</td>
                            <td><address>{{$o->ship->address}}<br>{{$o->ship->city}} {{$o->ship->zipcode}}<br>{{$o->ship->state}} {{$o->ship->country}}</address></td>
                            <td>{{$o->placed_at}}</td>
                            <td>{{$o->paymentamt}}</td>
                            @if($o->status==1)
                            <td style="color:orange">Pending</td>
                            @else
                            <td style="color:cyan">Processing</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div><br>
                    <div class="dash-box">
                        <img src="images/block.png" height="30px" width="30px">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam ipsa illum, in impedit sapiente ab ullam</p><br>
                    </div> <br>
                    <!-- <div class="dash-box">
                        <img src="images/stock.png" height="30px" width="30px">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam ipsa illum, in impedit sapiente ab ullam</p><br>
                    </div> <br> -->

           
        </div>

</body>