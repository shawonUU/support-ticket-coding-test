@extends('layouts.app')
@section('style')
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-2">
        <div class="form-group">
            <label for="from">From</label>
            <input id="from" type="date" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-2">
        <div class="form-group">
            <label for="to">To</label>
            <input id="to" type="date" class="form-control"  placeholder="">
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-2">
        <div class="form-group">
            <label for="number">Number</label>
            <input id="number" type="text" class="form-control"  placeholder="">
        </div>
    </div>
    @if(isAdmin())
        <div class="col-12 col-md-6 col-lg-2">
            <div class="form-group">
                <label for="customer">Customer</label>
                <select id="customer" class="custom-select custom-select-lg form-control mb-3">
                    <option value="">All</option>
                    @foreach ($customers as $customer) )
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    <div class="col-12 col-md-6 col-lg-2">
        <label for=""></label>
        <div class="form-group">
            <button onclick="getTickets()" class="btn btn-primary">Search</button>
        </div>
    </div>
</div>
<div id="ticketList">

</div>
@endsection

@section("script")
<script>
    getTickets();
    function getTickets(){
        var from = document.getElementById("from").value.trim();
        var to = document.getElementById("to").value.trim();
        var number = document.getElementById("number").value.trim();
        var customer = "";
        if(document.getElementById("customer")){
            customer = document.getElementById("customer").value.trim();
        }
        var status = "";
        if(document.getElementById("status")){
            status = document.getElementById("status").value.trim();
        }
        

        $.get('{{route('get_tickets')}}', {get_from:'closed',from:from,to:to,number:number,customer:customer,status:status}, function(data){
            document.getElementById("ticketList").innerHTML = data;
        });
    }
</script>
@endsection