@extends('layouts.app')
@section('style')

@endsection
@section('content')
    <form method="post" action="{{route('ticket.update', $ticket->id)}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="title" class="mendatory">Ticket Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$ticket->title}}" required>
        </div>
        <div class="form-group">
            <label for="description" class="mendatory">Description</label>
            <textarea name="description" id="description" class="form-control w-100" rows="5" required>{{$ticket->description}}</textarea>
        </div>
        <div class="form-group d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection

@section("script")
   
@endsection