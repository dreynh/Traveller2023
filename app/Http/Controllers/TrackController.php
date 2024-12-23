<?php

namespace App\Http\Controllers;

use App\Models\track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.track.index', [
            'tracks' => track::all()
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
            'from_route' => ['required'],
            'to_route' => ['required']
        ]);

        if (track::where('from_route', $request['from_route'])->where('to_route', $request['to_route'])->first()) {
            return redirect('/tracks')->with('sameRoute', 'Rute tersebut sudah ada di database!');
        }

        track::create($validatedData);

        return redirect('/tracks')->with('store', 'Rute tersebut berhasil ditambahkan!');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\track  $track
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(track $track)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\track  $track
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(track $track)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, track $track)
    {
        $validatedData = $request->validate([
            'from_route' => ['required'],
            'to_route' => ['required']
        ]);

        $check = track::where('id', '!=', $track->id)->where('from_route', $validatedData['from_route'])->where('to_route', $validatedData['to_route'])->first();

        if ($check) {
            return redirect('/tracks')->with('sameRoute', 'Rute tersebut sudah ada di database!');
        }

        $track->update($validatedData);

        return redirect('/tracks')->with('update', 'Rute tersebut berhasil diubah!');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(track $track)
    {
        $track->delete();
        return redirect('/tracks')->with('delete', 'Rute tersebut berhasil dihapus');
    }
}