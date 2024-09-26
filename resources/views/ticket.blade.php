<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Ticket No</th>
        <th scope="col">Opening Date</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        @if(isAdmin())
        <th scope="col">Customer</th>
        @endif
        @if($getFrom=="dashboard")
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <th scope="row">{{$ticket->ticket_number}}</th>
                <td>{{$ticket->created_at->format('d-m-Y')}}</td>
                <td>{{$ticket->title}}</td>
                <td>{{$ticket->description}}</td>
                @if(isAdmin())
                <td>{{$ticket->name}}</td>
                @endif
                @if($getFrom=="dashboard")
                    <td><span class="badge badge-primary {{getArrayData(getStatusBadge(),$ticket->status)}}">{{getArrayData(statuses(),$ticket->status)}}</span></td>
                    
                    <td>
                        @if(isAdmin())
                            <select onchange="updateStatus({{$ticket->id}}, this.value)" class="custom-select custom-select-lg mb-3">
                                @foreach (statuses() as $key => $status) )
                                    <option value="{{$key}}" {{$ticket->status == $key ? 'selected' : ''}}>{{$status}}</option>
                                @endforeach
                            </select>
                        @endif
                        @if(isCustomer() && $ticket->status != 3)
                            <a href="{{route('ticket.edit', $ticket->id)}}" class="btn btn-sm btn-danger">Edit</a>
                        @endif
                    </td>
                @endif
                
            </tr>
        @endforeach
    </tbody>
</table>