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
      <!-- <th scope="col">Customer</th> -->
      <th scope="col">Min Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php($i=1)
    @foreach($store as $store)
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$store->btitle}} - {{$store->bauthor}}</td>
      
      <td>{{$store->minprice}}</td>
      @if($store->status==0)
      <td>Sold</td>
      @elseif($store->status==1)
      <td>In store</td>
      @elseif($store->status==2)
      <td>Biding Active</td>
      @else
      <td>Biding Requested</td>
      @endif
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="location.href='{{route('viewthrift',['accId'=>$store->bookid,'userid'=>$store->userid])}}'">
                View
            </button>
        </div>
      </td>
    </tr>
    @php($i=$i+1)
    @endforeach
  </tbody>
</table>

</div>
@endsection