<?php

namespace App\Http\Controllers;

use App\Models\travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.travel.index', [
            'travel' => travel::all()
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'gate' => ['required', 'min:3', 'max:10'],
        ]);

        $check = travel::where('name', $validatedData['name'])->first();

        if ($check) {
            return redirect('/travel')->with('sameTravel', 'Travel tersebut sudah ada di database!');
        }

        travel::create($validatedData);

        return redirect('/travel')->with('store', 'Data Travel Berhasil Ditambahkan!');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\travel  $travel
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(travel $travel)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\travel  $travel
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(travel $travel)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, travel $travel)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'gate' => ['required', 'min:3', 'max:10'],
        ]);

        $check = travel::where('id', '!=', $travel->id)->where('name', $validatedData['name'])->where('gate', $validatedData['gate'])->first();

        if ($check) {
            return redirect('/travel')->with('sameTravel', 'Travel tersebut sudah ada di database!');
        }

        $travel->update($validatedData);

        return redirect('/travel')->with('update', 'Data Travel Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(travel $travel)
    {
        $travel->delete();
        return redirect('/travel')->with('delete', 'Data Travel Berhasil Dihapus');
    }
}