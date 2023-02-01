@extends('layouts.usertemp')
@section('username',$user->fullname)
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="jquery-3.6.0.min.js"></script>
  <title>Basket</title>
  <style>
    @charset "utf-8";

    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700,600);

    html,
    html a {
    -webkit-font-smoothing: antialiased;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
    }

    body {
    background-color: #fff;
    color: #666;
    font-family: 'Open Sans', sans-serif;
    font-size: 62.5%;
    margin: 0 auto;
    }

    a {
    border: 0 none;
    outline: 0;
    text-decoration: none;
    }

    strong {
    font-weight: bold;
    }

    p {
    margin: 0.75rem 0 0;
    }

    h1 {
    font-size: 0.75rem;
    font-weight: normal;
    margin: 0;
    padding: 0;
    }

    input,
    button {
    border: 0 none;
    outline: 0 none;
    }

    button {
    background-color: #666;
    color: #fff;
    }

    button:hover,
    button:focus {
    background-color: #555;
    }

    img,
    .basket-module,
    .basket-labels,
    .basket-product {
    width: 100%;
    }

    input,
    button,
    .basket,
    .basket-module,
    .basket-labels,
    .item,
    .price,
    .quantity,
    .subtotal,
    .basket-product,
    .product-image,
    .product-details {
    float: left;
    }

    .hide {
    display: none;
    }

    main {
    clear: both;
    font-size: 0.75rem;
    margin: 0 auto;
    overflow: hidden;
    padding: 1rem 0;
    width: 960px;
    }

    .basket,
    aside {
    padding: 0 1rem;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    }

    .basket {
    width: 70%;
    }

    .basket-module {
    color: #111;
    }

    label {
    display: block;
    margin-bottom: 0.3125rem;
    }

    .basket-labels {
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    margin-top: 1.625rem;
    }

    ul {
    list-style: none;
    margin: 0;
    padding: 0;
    }

    li {
    color: #111;
    display: inline-block;
    padding: 0.625rem 0;
    }

    li.price:before,
    li.subtotal:before {
    content: '';
    }

    .item {
    width: 55%;
    }

    .price,
    .quantity,
    .subtotal {
    width: 15%;
    }

    .subtotal {
    text-align: right;
    }

    .remove {
    bottom: 1.125rem;
    float: right;
    position: absolute;
    right: 0;
    text-align: right;
    width: 45%;
    }

    .remove button {
    background-color: transparent;
    color: #777;
    float: none;
    text-decoration: underline;
    text-transform: uppercase;
    }

    .item-heading {
    padding-left: 4.375rem;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    }

    .basket-product {
    border-bottom: 1px solid #ccc;
    padding: 1rem 0;
    position: relative;
    }

    .product-image {
    width: 15%;
    }

    .product-details {
    width: 65%;
    }

    .product-frame {
    border: 1px solid #aaa;
    }

    .product-details {
    padding: 0 1.5rem;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    }

    .quantity-field {
    background-color: #ccc;
    border: 1px solid #aaa;
    border-radius: 4px;
    font-size: 0.625rem;
    padding: 2px;
    width: 3.75rem;
    }

    aside {
    float: right;
    position: relative;
    width: 30%;
    }

    .summary {
    background-color: #eee;
    border: 1px solid #aaa;
    padding: 1rem;
    position: fixed;
    width: 250px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    }

    .summary-total-items {
    color: #666;
    font-size: 0.875rem;
    text-align: center;
    }

    .summary-subtotal,
    .summary-total {
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    clear: both;
    margin: 1rem 0;
    overflow: hidden;
    padding: 0.5rem 0;
    }

    .subtotal-title,
    .subtotal-value,
    .total-title,
    .total-value,
    .promo-title,
    .promo-value {
    color: #111;
    float: left;
    width: 50%;
    }

    .summary-promo {
    -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
    }

    .promo-title {
    float: left;
    width: 70%;
    }

    .promo-value {
    color: #8B0000;
    float: left;
    text-align: right;
    width: 30%;
    }

    .summary-delivery {
    padding-bottom: 3rem;
    }

    .subtotal-value,
    .total-value {
    text-align: right;
    }

    .total-title {
    font-weight: bold;
    text-transform: uppercase;
    }

    .summary-checkout {
    display: block;
    }

    .checkout-cta {
    display: block;
    float: none;
    font-size: 0.75rem;
    text-align: center;
    text-transform: uppercase;
    padding: 0.625rem 0;
    width: 100%;
    }

    .summary-delivery-selection {
    background-color: #ccc;
    border: 1px solid #aaa;
    border-radius: 4px;
    display: block;
    font-size: 0.625rem;
    height: 34px;
    width: 100%;
    }

    @media screen and (max-width: 640px) {
    aside,
    .basket,
    .summary,
    .item,
    .remove {
        width: 100%;
    }
    .basket-labels {
        display: none;
    }
    .basket-module {
        margin-bottom: 1rem;
    }
    .item {
        margin-bottom: 1rem;
    }
    .product-image {
        width: 20%;
    }
    .product-details {
        width: 60%;
    }
    .price,
    .subtotal {
        width: 33%;
    }
    .quantity {
        text-align: center;
        width: 34%;
    }
    .quantity-field {
        float: none;
    }
    .remove {
        bottom: 0;
        text-align: left;
        margin-top: 0.75rem;
        position: relative;
    }
    .remove button {
        padding: 0;
    }
    .summary {
        margin-top: 1.25rem;
        position: relative;
    }
    }

    @media screen and (min-width: 641px) and (max-width: 960px) {
    aside {
        padding: 0 1rem 0 0;
    }
    .summary {
        width: 28%;
    }
    }

    @media screen and (max-width: 960px) {
    main {
        width: 100%;
    }
    .product-details {
        padding: 0 1rem;
    }
    }
  </style>
  <script type="text/javascript">
    /* Set values + misc */
        var promoCode;
        var promoPrice;
        var fadeTime = 300;

        /* Assign actions */
        $('.quantity input').change(function() {
        updateQuantity(this);
        });

        $('.remove button').click(function() {
        removeItem(this);
        });

        $(document).ready(function() {
        updateSumItems();
        });

        $('.promo-code-cta').click(function() {

        promoCode = $('#promo-code').val();

        if (promoCode == '10off' || promoCode == '10OFF') {
            //If promoPrice has no value, set it as 10 for the 10OFF promocode
            if (!promoPrice) {
            promoPrice = 10;
            } else if (promoCode) {
            promoPrice = promoPrice * 1;
            }
        } else if (promoCode != '') {
            alert("Invalid Promo Code");
            promoPrice = 0;
        }
        //If there is a promoPrice that has been set (it means there is a valid promoCode input) show promo
        if (promoPrice) {
            $('.summary-promo').removeClass('hide');
            $('.promo-value').text(promoPrice.toFixed(2));
            recalculateCart(true);
        }
        });

        /* Recalculate cart */
        function recalculateCart(onlyTotal) {
        var subtotal = 0;

        /* Sum up row totals */
        $('.basket-product').each(function() {
            subtotal += parseFloat($(this).children('.subtotal').text());
        });

        /* Calculate totals */
        var total = subtotal;

        //If there is a valid promoCode, and subtotal < 10 subtract from total
        var promoPrice = parseFloat($('.promo-value').text());
        if (promoPrice) {
            if (subtotal >= 10) {
            total -= promoPrice;
            } else {
            alert('Order must be more than £10 for Promo code to apply.');
            $('.summary-promo').addClass('hide');
            }
        }

        /*If switch for update only total, update only total display*/
        if (onlyTotal) {
            /* Update total display */
            $('.total-value').fadeOut(fadeTime, function() {
            $('#basket-total').html(total.toFixed(2));
            $('.total-value').fadeIn(fadeTime);
            });
        } else {
            /* Update summary display. */
            $('.final-value').fadeOut(fadeTime, function() {
            $('#basket-subtotal').html(subtotal.toFixed(2));
            $('#basket-total').html(total.toFixed(2));
            if (total == 0) {
                $('.checkout-cta').fadeOut(fadeTime);
            } else {
                $('.checkout-cta').fadeIn(fadeTime);
            }
            $('.final-value').fadeIn(fadeTime);
            });
        }
        }
 
        

  </script>
</head>

@section('content')
@php($totalamt=0)
<div id="mid-view" class="child-element" style="width:1100px;margin-top:1%;margin-left:3%;">
@if(count($cart)==0)
<br><br>
<div class="card">
  <div class="card-body">
    <center><img src="{{asset('images/emptycart.png')}}" alt="empty cart" style="width:100px;height:100px;"><br>
    <p><b>This cart is empty</b></p>
    <p><a href="/memsearch">Go ahead and stack your library.</a></p>
    <p>Happy Shopping :)</p>
    </center>
  </div>
</div>
@else
    <div class="basket">
      <div class="basket-labels">
        <ul>
          <li class="item item-heading">Item</li>
          <li class="price">Price</li>
          <li class="quantity">Quantity</li>
          <li class="subtotal">Subtotal</li>
        </ul>
      </div>
      @foreach($cart as $item)
      <div class="basket-product">
        <div class="item">
          <div class="product-image">
            <img src="{{ asset('coverpics/'.$item->stocks->products->cov_pic)}}" alt="Placholder Image 2" class="product-frame">
          </div>
          <div class="product-details">
            <h5><strong>{{$item->stocks->products->title}}</strong></h5>
            <h6>Type: {{$item->stocks->type}}</h6>
          </div>
        </div>
        @php($price = ($item->stocks->price)-(($item->stocks->discount*$item->stocks->price)/100))
        <div class="price">₹{{$price}}</div>
        <form id="form" action="{{route('updatecart',$item->cartid)}}" method="POST">
            @csrf
          <div class="quantity">
            <input type="number" value="{{$item->qty}}" min="1" max="{{$item->stocks->qty}}" class="quantity-field" name="qty" onchange="submit()" oninput="this.value = 
 !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
          </div>
        </form>
        <script>
            function submit(){
                document.getElementById("form").submit();
            }
        </script>
        @php($subtotal = $price*$item->qty)
        <div class="subtotal">₹{{$subtotal}}</div>
        @php($totalamt=$totalamt+$subtotal)
        <div class="remove">
          <a href="{{route('deletebook',$item->cartid)}}" style="color:red;">Remove</a>
        </div>
      </div>
      @endforeach
    </div>
    <aside>
      <div class="summary">
        <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
        <div class="summary-subtotal">
          <div class="subtotal-title">Subtotal</div>
          <div class="subtotal-value final-value" id="basket-subtotal">₹{{$totalamt}}</div>
        </div>
        <div class="summary-delivery">
          <select name="delivery-collection" class="summary-delivery-selection">
             <option value="Card" selected="selected">CardPayment</option>
             <option value="COD">COD</option>
          </select><br>
          @if($totalamt< 750 && $totalamt!=0)
          <p><small>Delivery Charge : ₹50 </small></p>
          @php($flag=1)
          @else
          <p><small>Delivery Charge: ₹0</small></p>
          @php($flag=0)
          @endif
        </div>
        <div class="summary-total">
          <div class="total-title">Total</div>
          @if($flag==0)
          <div class="total-value final-value" id="basket-total">₹{{$totalamt}}</div>
          @else  
          <div class="total-value final-value" id="basket-total">₹{{$totalamt+50}}</div>
          @endif
        </div>
       
        <div class="summary-checkout">
          <button class="checkout-cta"><a href="/address"><span style="color:white">Go to Secure Checkout</span></a></button>
        </div>
      </div>
    </aside>
    @endif
</div>
@endsection