<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Confirmation</title>
  <style>
    #dashboard{
            margin-right:7%;
            margin-left:3%;
            margin-top: 50px;
            font-family:cursive;
            
        }
        #mid-view{
            margin-left:15%;
            width:800px;
            margin-top:-5%;
            border:1px solid black;
        }
        #invoice{
            margin-left:4%;
            margin-right:4%;
            
        }
        .heading{
            padding:10px;
            background-color:black;
            color:white;
        }

        .order-details{
            padding:20px;
            text-align:center;
        }
        .item-details{
            border-collapse:collapse;
            border:1px solid black;
            padding:20px;
            text-align:center;
        }
  </style>
</head>
<body>
<div id="dashboard">
    <div id="mid-view" class="child-element" style="width:700px;margin-top:1%;margin-left:-3%;">
            <div class="heading">
                <h2> BLOUNGE </h2> 
            </div>
            <div id="invoice">
                <p><b>Your order confirmed!</b></p>
                <span>Hello, {{$user->fullname}}. </span> <span>You order has been confirmed and will be shipped soon!</span>
                <table class="order-details">
                    <tr class="order-details">
                        <th class="order-details">Order placed at</th>
                        <th class="order-details">Order No</th>
                        <th class="order-details">Payment</th>
                        <th class="order-details">Shipping Address</th>
                    </tr>
                    <tr>
                        <td class="order-details">{{$orders->placed_at}}</td>
                        <td class="order-details">BL{{$orders->orderid}}</td>
                        <td class="order-details"> COD </td>
                        <td class="order-details">{{$ship->firstname}} {{$ship->lastname}} <br> {{$ship->address}}<br> {{$ship->city}} {{$ship->zipcode}}<br> {{$ship->state}} {{$ship->country}}</td>
                    </tr>
                </table>
                <table class="item-details" style="margin-left:2%;">
                    <tr>
                        <th class="item-details" style="font-size:15px;"> Product Description </th>
                        <th class="item-details" style="font-size:15px;"> Product Quantity </th>
                        <th class="item-details" style="font-size:15px;"> Product Type </th>
                        <th class="item-details" style="font-size:15px;"> Product Price </th>
                    </tr>
                    @foreach($cart as $item)
                    <tr class="item-details">
                        <td width="60%" class="item-details"> {{$item->stocks->products->title}}</td>
                        <td width="60%" class="item-details"> {{$item->qty}}</td>
                        <td width="60%" class="item-details"> {{$item->stocks->type}}</td>
                        <td width="20%" class="item-details"> Rs {{$item->qty*$item->stocks->price}}</td>
                    </tr>
                    @endforeach
                    <tr style="">
                        <th colspan="3" style="text-align:right;">Sub Charge</th>
                        <td> Rs {{$orders->totalamt}} </td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:right;border-down:1px solid black;">Shipping Fee</th>
                        <td>
                            @if($orders->totalamt>750)
                            <div> <span> Rs 0</span> </div>
                            @else
                            <div> <span> Rs 50</span> </div>
                            @endif 
                        </td>
                    </tr>
                    <tr class="item-details">
                        <th colspan="3" style="text-align:right;">Sub Total</th>
                        <td> Rs {{$orders->paymentamt}} </td>
                    </tr>
                </table>
            </div>
        <br><br>
        <div class="heading">
            <span> Thank you for shopping with us!</span>
            <span style="margin-left:50%;">{{date("d-m-y h:i:s")}}</span>
        </div>

    </div>
</div>
</body>
