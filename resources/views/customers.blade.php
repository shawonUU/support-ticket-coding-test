@extends('layouts.app')
@section('style')
@endsection
@section('content')
<div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Sl</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section("script")

@endsection