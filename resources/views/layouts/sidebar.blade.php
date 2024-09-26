@auth
<div id="sidebar" class="col-auto col-md-2 col-xl-2 px-sm-2 px-0 bg-light" style="max-width: 300px !important;">
    <div class="d-flex flex-column align-items-center align-items-sm-start pt-2 text-white min-vh-100">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100 mt-3" id="menu">
            <li class="nav-item p-2 w-100 rounded">
                <a href="{{url('/')}}" class="nav-link align-middle px-0 py-1">
                    Dashboard
                </a>
            </li>
            @if(isCustomer())
            <li class="nav-item p-2 w-100 rounded py-0">
                <a href="{{route('ticket.index')}}" class="nav-link align-middle px-1">
                    Open a Ticket
                </a>
            </li>
            @endif
            <li class="nav-item p-2 w-100 rounded py-0">
                <a href="{{route('home.closed_ticket')}}" class="nav-link align-middle px-1">
                    Closed Ticket
                </a>
            </li>
            @if(isAdmin())
            <li class="nav-item p-2 w-100 rounded py-0">
                <a href="{{route('home.customers')}}" class="nav-link align-middle px-1">
                    Customer List
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
@endauth