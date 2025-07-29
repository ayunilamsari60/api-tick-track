<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function store(TicketStoreRequest $request) 
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $ticket = new Ticket;
            $ticket->user_id = auth()->user()->id;
            $ticket->code = 'TIC-' . rand(10000, 99999);
            $ticket->title = $data['title'];
            $ticket->description = $data['description'];
            $ticket->priority = $data['priority'];
            $ticket->save();

            DB::commit();

            return response()->json([
                'message' => 'Tiket berhasil ditambahkan',
                'data' => 
            ], 201);
        } catch (\Throwable $th) {
        }
    }
}
