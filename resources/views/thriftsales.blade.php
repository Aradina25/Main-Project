@extends('layouts.usertemp')
@extends('layouts.sidebar')
@section('title','HOME')
@section('username',$user->fullname)
@section('width',$width)
@section('comptgoal',$challenge->completedgoal)
@section('goal',$challenge->goal)
<style>
    #sales-tab td:first-child:before{
    counter-increment: Serial;
    content:counter(Serial);
}
</style>
@section('content')
<div id="mid-view" class="child-element" style="width:750px;margin-top:3%;">
<h3>Current Sales</h3><br><br>
<table class="table" id="sales-tab" style="background-color:white;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item</th>
      <th scope="col">Customer</th>
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($currentsales as $c)
    <tr>
      <th scope="row">1</th>
      <td>{{$c->store->btitle}} - {{$c->store->bauthor}}</td>
      <td><img src="{{asset('profilepictures/'.$c->pics->picture)}}" width="50px" height="50px" style="border-radius:50px;"></td>
      <td>{{$c->negoamt}}</td>
      <td>{{$c->action}}</td>
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('sellernego',['Id'=>$c->id,'action'=>'Accepted'])}}">Accept</a>
                <a class="dropdown-item" href="{{route('sellernego',['Id'=>$c->id,'action'=>'Declined'])}}">Decline</a>
            </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection