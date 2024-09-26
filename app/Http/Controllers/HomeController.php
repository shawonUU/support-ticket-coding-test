<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = User::where('user_type', 2)->get();
        return view('dashboard', compact('customers'));
    }

    public function closedTicket(){
        $customers = User::where('user_type', 2)->get();
        return view('closed_tickets', compact('customers'));
    }

    public function getTickets(Request $request){

        // get_from:'dashboard',from:from,to:to,number:number,customer:customer,status:status

        $startdate = Carbon::parse($request->from)->startOfDay()->format('Y-m-d H:i:s');
        $enddate = Carbon::parse($request->to)->endOfDay()->format('Y-m-d H:i:s');
        $tickets = Ticket::join('users','users.id','=','tickets.user_id');

        if ($request->from != "" && $request->to != "") {
            $tickets = $tickets->whereBetween('tickets.created_at', [$startdate, $enddate])
                ->whereDate('tickets.created_at', '>=', $startdate)
                ->whereDate('tickets.created_at', '<=', $enddate);
        }
        if($request->number != ""){
            $tickets = $tickets->where('ticket_number', $request->number);
        }
        if($request->status && $request->status != ""){
            $tickets = $tickets->where('status', $request->status);
        }else{
            if($request->get_from == "dashboard"){
                $tickets = $tickets->whereIn('status',[1,2]);
            }
            if($request->get_from == "closed"){
                $tickets = $tickets->whereIn('status',[3]);
            }
        }
        if(isAdmin()){
            if($request->customer && $request->customer != ""){
                $tickets = $tickets->where('user_id', $request->customer);
            }
        }elseif(isCustomer()){
            $tickets = $tickets->where('user_id', auth()->user()->id);
        }
        $tickets = $tickets->select('tickets.*','users.name')->get();

        $getFrom = $request->get_from;

        return view('ticket', compact('tickets','getFrom'));
    }

    public function customers(){
        $customers = User::where('user_type', 2)->get();
        return view('customers', compact('customers'));
    }
}
