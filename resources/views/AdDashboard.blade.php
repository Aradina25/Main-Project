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
                <li  id="author"><a href="/adauthor">AUTHOR</a></li>
                <li  id="member"><a href="/admembers">MEMBERS</a></li>
                <li  id="order"><a href="/adorders">ORDERS</a></li>
                <li id="Logout"><a href="/logout">LOG OUT</a></li>
            </ul>
    </div>
        <div id="dashboard"><br>
            <br><br><h2>DASHBOARD</h2><br>
            <div class="cont">
                <div class="row">
                    
                    <div id="box1" class="dash-box">
                        <img src="" height="30px" width="30px">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam ipsa illum, in impedit sapiente ab ullam</p><br>
                    </div>
                    <div id="box2" class="dash-box">
                        <img src="" height="30px" width="30px">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos laboriosam ipsa illum, in impedit sapiente ab ullam</p><br>
                    </div> 
                </div>
            </div>
            
        </div>

</body>