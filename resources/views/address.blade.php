@extends('layouts.usertemp')

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="jquery-3.6.0.min.js"></script>
  <title>Shipping address</title>
<style>
    @import url("https://rsms.me/inter/inter.css");

    :root {
    --color-gray: #737888;
    --color-lighter-gray: #e3e5ed;
    --color-light-gray: #f7f7fa;
    }

    *,
    *:before,
    *:after {
    box-sizing: inherit;
    }

    html {
    font-family: "Inter", sans-serif;
    font-size: 14px;
    box-sizing: border-box;
    }

    @supports (font-variation-settings: normal) {
    html {
        font-family: "Inter var", sans-serif;
    }
    }

    body {
    margin: 0;
    }

    h1 {
    margin-bottom: 1rem;
    }

    p {
    color: var(--color-gray);
    }

    hr {
    height: 1px;
    width: 100%;
    background-color: var(--color-light-gray);
    border: 0;
    margin: 2rem 0;
    }

    .container {
    max-width: 40rem;
    padding: 10vw 2rem 0;
    margin: 0 auto;
    height: 100vh;
    }

    .form {
    display: grid;
    grid-gap: 1rem;
    }

    .field {
    width: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid var(--color-lighter-gray);
    padding: .5rem;
    border-radius: .25rem;
    }

    .field__label {
    color: var(--color-gray);
    font-size: 0.6rem;
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 0.25rem
    }

    .field__input {
    padding: 0;
    margin: 0;
    border: 0;
    outline: 0;
    font-weight: bold;
    font-size: 1rem;
    width: 100%;
    -webkit-appearance: none;
    appearance: none;
    background-color: transparent;
    }
    .field:focus-within {
    border-color: #000;
    }

    .fields {
    display: grid;
    grid-gap: 1rem;
    }
    .fields--2 {
    grid-template-columns: 1fr 1fr;
    }
    .fields--3 {
    grid-template-columns: 1fr 1fr 1fr;
    }

    .button {
    background-color: #000;
    text-transform: uppercase;
    font-size: 0.8rem;
    font-weight: 600;
    display: block;
    color: #fff;
    width: 100%;
    padding: 1rem;
    border-radius: 0.25rem;
    border: 0;
    cursor: pointer;
    outline: 0;
    }
    .button:focus-visible {
    background-color: #333;
    }
</style>
<script>
    function ValidateFirstName()
    {
        inputText = document.getElementById("fname").value;
        var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
        if(inputText.match(regex))
            document.getElementById("fnameerr").innerHTML="";
        else
            document.getElementById("fnameerr").innerHTML="Invalid Name";
    }
    function ValidateLastName()
    {
        inputText = document.getElementById("lname").value;
        var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
        if(inputText.match(regex))
            document.getElementById("lnameerr").innerHTML="";
        else
            document.getElementById("lnameerr").innerHTML="Invalid Name";
    }

    function ValidateAddress()
    {
        inputText = document.getElementById("address").value;
        var regex = /^[a-zA-Z0-9\s,.'-/]{3,}$/;
        if(inputText.match(regex))
            document.getElementById("aderr").innerHTML="";
        else
            document.getElementById("aderr").innerHTML="Invalid Address";
    }
    function ValidateCountry()
    {
        inputText = document.getElementById("country").value;
        var regex = /^[^-\s][a-zA-Z ]{4,30}$/;
        if(inputText.match(regex))
            document.getElementById("coerr").innerHTML="";
        else
            document.getElementById("coerr").innerHTML="Invalid Country Name";
    }
    function ValidateZipCode()
    {
        inputText = document.getElementById("zipcode").value;
        var regex = /^[0-9]{6}|[0-9]{3}\s[0-9]{3}$/;
        if(inputText.match(regex))
            document.getElementById("ziperr").innerHTML="";
        else
            document.getElementById("ziperr").innerHTML="Invalid Zip Code";
    }

    function ValidateCity()
    {
        inputText = document.getElementById("city").value;
        var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
        if(inputText.match(regex))
            document.getElementById("cityerr").innerHTML="";
        else
            document.getElementById("cityerr").innerHTML="Invalid City Name";
    }

    function ValidateState()
    {
        inputText = document.getElementById("state").value;
        var regex = /^[^-\s][a-zA-Z ]{2,30}$/;
        if(inputText.match(regex))
            document.getElementById("stateerr").innerHTML="";
        else
            document.getElementById("stateerr").innerHTML="Invalid State Name";
    }
</script>
</head>
@section('content')
<div id="mid-view" class="child-element" style="width:1100px;margin-left:3%;">
<div class="container">
  <h1>Shipping Address</h1>
  <p>Please enter your shipping details.</p>
  <hr />
  <form action="/address_save" method="POST" class="form">
    @csrf
  <div class="fields fields--2">
    <label class="field">
      <small><span id="fnameerr" style="color:red;"></span></small>
      <span class="field__label" for="firstname">First name</span>
      <input class="field__input" type="text" id="fname" name="fname" onkeyup="ValidateFirstName()">
    </label>
    <label class="field">
      <small><span id="lnameerr" style="color:red;"></span></small>
      <span class="field__label" for="lastname">Last name</span>
      <input class="field__input" type="text" id="lname" name="lname"onkeyup="ValidateLastName()" />
    </label>
  </div>
  <label class="field">
    <small><span id="aderr" style="color:red;"></span></small>
    <span class="field__label" for="address">Address</span>
    <input class="field__input" type="text" id="address" name="address" onkeyup="ValidateAddress()" />
  </label>
  <label class="field">
    <small><span id="coerr" style="color:red;"></span></small>
    <span class="field__label" for="country">Country</span>
    <input class="field__input" type="text" id="country" name="country" onkeyup="ValidateCountry()" />
  </label>
  <div class="fields fields--3">
    <label class="field">
      <small><span id="ziperr" style="color:red;"></span></small>
      <span class="field__label" for="zipcode">Zip code</span>
      <input class="field__input" type="text" id="zipcode" name="zipcode" onkeyup="ValidateZipCode()" />
    </label>
    <label class="field">
      <small><span id="cityerr" style="color:red;"></span></small>
      <span class="field__label" for="city">City</span>
      <input class="field__input" type="text" id="city" name="city" onkeyup="ValidateCity()" />
    </label>
    <label class="field">
      <small><span id="stateerr" style="color:red;"></span></small>
      <span class="field__label" for="state">State</span>
      <input class="field__input" type="text" id="state" name="state" onkeyup="ValidateState()">
    </label>
  </div>
  <hr>
  <button class="button" type="submit">Continue</button>
</form>
  
</div>
</div>
@endsection