<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets=Ticket::paginate(10);
        return view('index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:3',
            'description'=>'required',
            'priority'=>'required'
        ],[
            'priority.required'=>'At least one priority should be selected !'
        ]);
        $ticket= new Ticket();
        $ticket->title=$request->title;
        $ticket->description=$request->description;
        $ticket->priority=$request->priority;
        $ticket->save();
        return response()->json([
            'message' => 'Ticket created successfully',
            'data'=>$ticket
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
