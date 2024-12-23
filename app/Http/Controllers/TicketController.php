<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Models\travel;
use App\Models\type;
use App\Models\track;
use App\Models\price;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $this->authorize('isAdmin');

        // if (Gate::allows('isAdmin')) {
        return view('dashboard.ticket.index', [
            'tickets' => ticket::all()->load('price'),
            'travel' => travel::all(),
            'types' => type::all(),
            'tracks' => track::all()
        ]);
        // } else {
        //     // akses logic untuk user selain role admin
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     // return view('admin.dashboard.ticket.index', [
    //     //     
    //     // ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'travel_id' => ['required'],
            'type_id' => ['required'],
            'track_id' => ['required'],
            'price' => ['required']
        ]);

        $validateSameTicket = ticket::where('travel_id', $validatedData['travel_id'])->where('type_id', $validatedData['type_id'])->where('track_id', $validatedData['track_id'])->first();

        if ($validateSameTicket) {
            return redirect('/tickets')->with('sameTicket', 'ticket dengan data tersebut sudah ada di database! jika ingin mengubah harga, masuk ke bagian harga!')->withInput();
        }

        ticket::create($validatedData);

        $currentTicket = ticket::where('travel_id', $validatedData['travel_id'])->where('type_id', $validatedData['type_id'])->where('track_id', $validatedData['track_id'])->first()->id;

        $validatedprice['ticket_id'] = $currentTicket;
        $validatedprice['price'] = $validatedData['price'];
        price::create($validatedprice);

        return redirect('/tickets')->with('success', 'Tiket berhasil ditambahkan');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\ticket  $ticket
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(ticket $ticket)
    // {
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\ticket  $ticket
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(ticket $ticket)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\ticket  $ticket
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, ticket $ticket)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ticket $ticket)
    {
        $ticket->destroy($ticket->id);
        return redirect('/tickets')->with('delete', "Tiket berhasil dihapus!");
    }
}