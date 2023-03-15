<head>
    <title>adminDasboard</title>
    <link rel="stylesheet" type="text/css" href="{{asset('addash.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
       
       google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([

            ['Month','Number'],
            @foreach($chart as $chart)
            @if($chart->year == '2023')
            @switch($chart->month)
                @case(1)
                    ['January',{{$chart->sales}}],
                    @break

                @case(2)
                    ['February',{{$chart->sales}}],
                    @break
                
                @case(3)
                    ['March',{{$chart->sales}}],
                    @break

                @case(4)
                    ['April',{{$chart->sales}}],
                    @break
                
                @case(5)
                    ['May',{{$chart->sales}}],
                    @break
            @endswitch
            @endif
            @endforeach
            
            ]);

            var options = {
            title: 'Sales Chart of the Year',
            titleTextStyle: {
                color: 'white',
            },
            
            pieHole: 0,
                pieSliceTextStyle: {
                    color: 'black',
                },
                is3D: true,
                backgroundColor: '#03528e',
                legend: 'none'
            };
            var chart = new google.visualization.PieChart(document.getElementById("piechart"));
            chart.draw(data,options);
            }
            
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
            <div class="container-fluid">
            <div id="piechart" style="width: 100%; height: 250px;"></div>
            </div><br>
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

            <br>
                      
        </div>

</body>