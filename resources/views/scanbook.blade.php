<head>
    <title>{{$viewbook->title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
   <style>
        #fixed-view{
            position:fixed;
            height:100%;
            width:160px;
        }

        .card{
            width:135px;
        }

        td{
            padding:5px;
        }

        sup{
            color: red;
        }

   </style>
</head>
<div id="dashboard">

<div id="view-spec-book">
            
    <div id="mid-view" class="child-element" style="background:white;">
            <div id="fixed-view" style="margin-left:20px;margin-top:50px;">
                <img src="{{ asset('coverpics/'.$viewbook->cov_pic)}}" id="cov-pic" width=150px; height=200px;><br><br>
                

                
            </div>
            
            <div id="rest-view" style="margin-left:200px;width:900px;margin-top:50px;">
                <h2>{{$viewbook->title}} - {{$viewbook->author}}</h2>
                <h6>Rating : {{$viewbook->rating-1}}/5</h6>
                <p style="text-align: justify">{{$viewbook->summary}}</p>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Book Details
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <table id="spec-book-tab">
                                    <tr>
                                        <td>Genre</td>
                                        <td>{{$viewbook->genre}} </td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        <td>{{$viewbook->language}} </td>
                                    </tr>
                                    <tr>
                                        <td>No.of pages</td>
                                        <td>{{$viewbook->pages}}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td> 
                                        <td>{{$viewbook->ISBN}} </td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>
                                        <td> {{$viewbook->publisher}} </td>
                                    </tr>
                                    <tr>
                                        <td>Publish Date</td>
                                        <td>{{$viewbook->publish_date}} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>   
            
            
        </div> 
    </div>
</div>

