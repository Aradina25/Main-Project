<head>
    <style>
    #sidebar{
            position:fixed;
            height:100%;
            width:160px;
            margin-left:1%;
            padding-left:2%;
            font-family:cursive;
            background:white;
            box-shadow: 5px 5px whitesmoke;
            
        }
        .icon{
            width:80px;
            height:80px;
        }
</style>
</head>
<body>
<div id="sidebar">
        <div id="reading-challenge" style="margin-top:40%;">
            <img src="{{ asset('images/readingchallenge.png')}}" class="icon" alt="reading-challenge"><br>
            <a href="" data-toggle="modal" data-target="#exampleModalCenter"><b>Reading Challenge</b></a>
            <div class="progress" style="width:120px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: @yield('width')%" aria-valuenow="@yield('comptgoal')" aria-valuemin="0" aria-valuemax="@yield('goal')">@yield('comptgoal')/@yield('goal')</div>
            </div>
        </div>
        <br><br>
        <div id="library">
            <img src="{{ asset('images/library.png')}}" id="library" class="icon" alt="library"><br>
            <a href="" data-toggle="modal" data-target="#MemberLibrary"><b>Your Shelf</b></a><br>
            
        </div>
        <div id="yourstore">
            <img src="{{ asset('images/yourstore.jpg')}}" id="store" class="icon" alt="yourstore" style="margin-top:30%;"><br>
            <a href="" data-toggle="modal" data-target="#yourstoremodal"><b>Your Store</b></a><br>
        </div>
</div>

</body>