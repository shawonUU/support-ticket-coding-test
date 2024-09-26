<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Mail\OpenTicketMail;
use Illuminate\Http\Request;
use App\Mail\CloseTicketMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index(Request $request){
        return view('customet.ticket.index');
    }

    public function store(Request $request){
        DB::beginTransaction();
        try{
            $userid = auth()->user()->id;
            $attributes = $request->all();
            $rules = [
                'title' => 'required',
                'description' => 'required',
            ];
            $validation = Validator::make($attributes, $rules);
            if ($validation->fails()) {
                throw new \Exception(implode('<br>', $validation->errors()->all()));
            }

            $latestTicket= Ticket::latest()->first();
            $lastTicketNumber = $latestTicket ? $latestTicket->ticket_number : 0;
            $lastTicketNumber = (int)$lastTicketNumber;
            $newTicketNumber = ++$lastTicketNumber;
            $newTicketNumber = str_pad($newTicketNumber, 6, '0', STR_PAD_LEFT);

            $ticket = new Ticket;
            $ticket->ticket_number = $newTicketNumber;
            $ticket->title = $attributes['title'];
            $ticket->description = $attributes['description'];
            $ticket->user_id = $userid;
            $ticket->save();

            Mail::to(adminMail())->send(new OpenTicketMail($ticket));

            DB::commit();
            return redirect()->back()->with(['success' => getNotify(1)]);
        }catch(\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
       
    }

    public function edit(Request $request, $id){
        $ticket = Ticket::where('id', $id)->first();
        if(!$ticket){abort(404);}
        return view('customet.ticket.edit', compact('ticket'));
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try{
            $ticket = Ticket::where('id', $id)->first();
            if(!$ticket){abort(404);}

            $userid = auth()->user()->id;
            $attributes = $request->all();
            $rules = [
                'title' => 'required',
                'description' => 'required',
            ];
            $validation = Validator::make($attributes, $rules);
            if ($validation->fails()) {
                throw new \Exception(implode('<br>', $validation->errors()->all()));
            }

            $ticket->title = $attributes['title'];
            $ticket->description = $attributes['description'];
            $ticket->update();

            DB::commit();
            return redirect()->back()->with(['success' => getNotify(1)]);
        }catch(\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function updateTicketStatus(Request $request){
        DB::beginTransaction();
        try{
            $userid = auth()->user()->id;
            $attributes = $request->all();
            $rules = [
                'ticket_id' => 'required|numeric',
                'status_id' => 'required|numeric|in:1,2,3',
            ];
            $validation = Validator::make($attributes, $rules);
            if ($validation->fails()) {
                throw new \Exception(implode('<br>', $validation->errors()->all()));
            }

            $ticket = Ticket::where('id', $attributes['ticket_id'])->first();
            if(!$ticket){
                throw new \Exception(getNotify(5));
            }

            $ticket->status = $attributes['status_id'];
            $ticket->update();

            if($attributes['status_id']==3){
                $customer = User::where('id', $ticket->user_id)->first();
                if(!$customer){
                    throw new \Exception(getNotify(5));
                }
                Mail::to($customer->email)->send(new CloseTicketMail($ticket));
            }
            
            DB::commit();
            return response()->json([
                'type' => 'success',
                'message' => getNotify(2),
            ]);
        }catch(\Throwable $e){
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
