<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\ticket;
use App\Models\track;
use App\Models\travel;
use App\Models\type;
use App\Models\method;
use App\Models\passenger;
use App\Models\transaction;
use App\Models\complaint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            return view('dashboard.order.index', [
                'orders' => order::all(),
                'complaints' => complaint::all()
            ]);
        } else {
            return view('dashboard.order.index', [
                'orders' => order::where('user_id', Auth::id())->get(),
                'complaints' => complaint::all(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view("dashboard.order.create", [
            "routes" => track::all(),
            'travel' => travel::all(),
            'types' => type::all(),
            'tickets' => ticket::all(),
            'methods' => method::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request)
    {
        $trackChecker = track::where('from_route', $request['from_route'])->where('to_route', $request['to_route'])->first();
        $trackChecker2 = track::where('from_route', $request['to_route'])->where('to_route', $request['from_route'])->first();

        if ($trackChecker) {
            $trackCheckerId = $trackChecker->id;
        } else {
            $trackCheckerId = 0;
        }

        if ($trackChecker2) {
            $trackChecker2Id = $trackChecker2->id;
        } else {
            $trackChecker2Id = 0;
        }

        $ticketChecker1 = ticket::where('travel_id', $request['travel_id'])->where('type_id', $request['type_id'])->where('track_id', $trackCheckerId)->first();
        $ticketChecker2 = ticket::where('travel_id', $request['travel_id'])->where('type_id', $request['type_id'])->where('track_id', $trackChecker2Id)->first();

        if (!$ticketChecker1) {
            return redirect('/orders/create')
                ->with('ticketNotFound1', 'Maaf, tiket berangkat anda tidak tersedia. Dimohon untuk memilih tiket yang lain.')
                ->withInput();
        }

        if (!$ticketChecker2 && $request['round_trip'] == "true") {
            return redirect('/orders/create')
                ->with('ticketNotFound2', 'Maaf, tiket pulang anda tidak tersedia. Dimohon untuk memilih tiket yang lain.')
                ->withInput();
        }


        if ($request['round_trip'] == "true") {
            $validatedReturnDate = $request->validate([
                'return_date' => ['required']
            ]);
        }
        ;

        $validatedDataorder = $request->validate([
            'from_route' => ['required'],
            'to_route' => ['required'],
            'travel_id' => ['required'],
            'type_id' => ['required'],
            'round_trip' => ['required'],
            'amount' => ['required'],
            'go_date' => ['required'],
        ]);

        if ($validatedDataorder['round_trip'] == "true") {
            $validatedDataorder['round_trip'] = true;
        } else {
            $validatedDataorder['round_trip'] = false;
        }

        $validatedDataorder['user_id'] = auth()->user()->id;
        $order_code1 = strval(number_format(microtime(true) * 1000, 0, '.', ''));
        $validatedDataorder['order_code'] = $order_code1;

        $from_route = $request['from_route'];
        $to_route = $request['to_route'];
        $travel_id = $request['travel_id'];
        $type_id = $request['type_id'];

        $track_id = track::where('from_route', $from_route)->where('to_route', $to_route)->first()->id;

        $validatedDataorder['ticket_id'] = ticket::where('travel_id', $travel_id)->where('type_id', $type_id)->where('track_id', $track_id)->first()->id;

        order::create($validatedDataorder);

        // Transaction 1

        $validatedDataTransaction = $request->validate([
            'method_id' => ['required'],
            'name_account' => ['required'],
            'from_account' => ['required']
        ]);

        $order1 = order::where('order_code', $order_code1)->first();

        $validatedDataTransaction['order_id'] = $order1->id;

        $validatedDataTransaction['total'] = $order1->ticket->price->price * $validatedDataorder['amount'];

        $validatedDataTransaction['status'] = false;

        Transaction::create($validatedDataTransaction);

        sleep(1);

        if ($validatedDataorder['round_trip'] == true) {
            $validatedDataorder2 = $request->validate([
                'from_route' => ['required'],
                'to_route' => ['required'],
                'travel_id' => ['required'],
                'type_id' => ['required'],
                'round_trip' => ['required'],
                'amount' => ['required'],
            ]);

            if ($validatedDataorder2['round_trip'] == "true") {
                $validatedDataorder2['round_trip'] = true;
            } else {
                $validatedDataorder2['round_trip'] = false;
            }

            $validatedDataorder2['user_id'] = auth()->user()->id;
            $order_code2 = strval(number_format(microtime(true) * 1000, 0, '.', ''));
            $validatedDataorder2['order_code'] = $order_code2;
            $validatedDataorder2['go_date'] = $validatedReturnDate['return_date'];

            $from_route = $request['to_route'];
            $to_route = $request['from_route'];
            $travel_id = $request['travel_id'];
            $type_id = $request['type_id'];

            $track_id = track::where('from_route', $from_route)->where('to_route', $to_route)->first()->id;

            $validatedDataorder2['ticket_id'] = ticket::where('travel_id', $travel_id)->where('type_id', $type_id)->where('track_id', $track_id)->first()->id;

            order::create($validatedDataorder2);

            $validatedDataTransaction2 = $request->validate([
                'method_id' => ['required'],
                'name_account' => ['required'],
                'from_account' => ['required']
            ]);

            $order2 = order::where('order_code', $order_code2)->first();

            $validatedDataTransaction2['order_id'] = $order2->id;

            $validatedDataTransaction2['total'] = $order2->ticket->price->price * $validatedDataorder['amount'];

            $validatedDataTransaction2['status'] = false;

            Transaction::create($validatedDataTransaction2);
        }

        $validatedDataPassengers1 = $request->validate([
            'nama_penumpang_1' => ['required',],
            'nik_penumpang_1' => ['required',],
            'jenis_penumpang_1' => ['required',]
        ]);

        if ($validatedDataPassengers1['jenis_penumpang_1'] == "true") {
            $validatedDataPassengers1['jenis_penumpang_1'] = true;
        } else {
            $validatedDataPassengers1['jenis_penumpang_1'] = false;
        }

        if ($request['nama_penumpang_2'] && $request['nik_penumpang_2'] && $request['jenis_penumpang_2']) {
            $validatedDataPassengers2 = $request->validate([
                'nama_penumpang_2' => [],
                'nik_penumpang_2' => [],
                'jenis_penumpang_2' => [],
            ]);

            if ($validatedDataPassengers2['jenis_penumpang_2'] == "true") {
                $validatedDataPassengers2['jenis_penumpang_2'] = true;
            } else {
                $validatedDataPassengers2['jenis_penumpang_2'] = false;
            }
        }

        if ($request['nama_penumpang_3'] && $request['nik_penumpang_3'] && $request['jenis_penumpang_3']) {
            $validatedDataPassengers3 = $request->validate([
                'nama_penumpang_3' => [],
                'nik_penumpang_3' => [],
                'jenis_penumpang_3' => [],
            ]);

            if ($validatedDataPassengers3['jenis_penumpang_3'] == "true") {
                $validatedDataPassengers3['jenis_penumpang_3'] = true;
            } else {
                $validatedDataPassengers3['jenis_penumpang_3'] = false;
            }
        }


        if ($request['nama_penumpang_4'] && $request['nik_penumpang_4'] && $request['jenis_penumpang_4']) {
            $validatedDataPassengers4 = $request->validate([
                'nama_penumpang_4' => [],
                'nik_penumpang_4' => [],
                'jenis_penumpang_4' => [],
            ]);

            if ($validatedDataPassengers4['jenis_penumpang_4'] == "true") {
                $validatedDataPassengers4['jenis_penumpang_4'] = true;
            } else {
                $validatedDataPassengers4['jenis_penumpang_4'] = false;
            }
        }

        if ($request['nama_penumpang_5'] && $request['nik_penumpang_5'] && $request['jenis_penumpang_5']) {
            $validatedDataPassengers5 = $request->validate([
                'nama_penumpang_5' => [],
                'nik_penumpang_5' => [],
                'jenis_penumpang_5' => [],
            ]);

            if ($validatedDataPassengers5['jenis_penumpang_5'] == "true") {
                $validatedDataPassengers5['jenis_penumpang_5'] = true;
            } else {
                $validatedDataPassengers5['jenis_penumpang_5'] = false;
            }
        }

        switch ($request['amount']) {
            case 5:
                $validatedRealPassenger5 = [];
                $validatedRealPassenger5['order_id'] = $order1->id;
                $validatedRealPassenger5['name'] = $validatedDataPassengers5['nama_penumpang_5'];
                $validatedRealPassenger5['id_number'] = $validatedDataPassengers5['nik_penumpang_5'];
                $validatedRealPassenger5['gender'] = $validatedDataPassengers5['jenis_penumpang_5'];
                Passenger::create($validatedRealPassenger5);
            case 4:
                $validatedRealPassenger4 = [];
                $validatedRealPassenger4['order_id'] = $order1->id;
                $validatedRealPassenger4['name'] = $validatedDataPassengers4['nama_penumpang_4'];
                $validatedRealPassenger4['id_number'] = $validatedDataPassengers4['nik_penumpang_4'];
                $validatedRealPassenger4['gender'] = $validatedDataPassengers4['jenis_penumpang_4'];
                Passenger::create($validatedRealPassenger4);
            case 3:
                $validatedRealPassenger3 = [];
                $validatedRealPassenger3['order_id'] = $order1->id;
                $validatedRealPassenger3['name'] = $validatedDataPassengers3['nama_penumpang_3'];
                $validatedRealPassenger3['id_number'] = $validatedDataPassengers3['nik_penumpang_3'];
                $validatedRealPassenger3['gender'] = $validatedDataPassengers3['jenis_penumpang_3'];
                Passenger::create($validatedRealPassenger3);
            case 2:
                $validatedRealPassenger2 = [];
                $validatedRealPassenger2['order_id'] = $order1->id;
                $validatedRealPassenger2['name'] = $validatedDataPassengers2['nama_penumpang_2'];
                $validatedRealPassenger2['id_number'] = $validatedDataPassengers2['nik_penumpang_2'];
                $validatedRealPassenger2['gender'] = $validatedDataPassengers2['jenis_penumpang_2'];
                Passenger::create($validatedRealPassenger2);
            case 1:
                $validatedRealPassenger1 = [];
                $validatedRealPassenger1['order_id'] = $order1->id;
                $validatedRealPassenger1['name'] = $validatedDataPassengers1['nama_penumpang_1'];
                $validatedRealPassenger1['id_number'] = $validatedDataPassengers1['nik_penumpang_1'];
                $validatedRealPassenger1['gender'] = $validatedDataPassengers1['jenis_penumpang_1'];
                Passenger::create($validatedRealPassenger1);
        }
        ;

        if ($validatedDataorder['round_trip'] == true) {
            switch ($request['amount']) {
                case 5:
                    $validatedRealPassenger5 = [];
                    $validatedRealPassenger5['order_id'] = $order2->id;
                    $validatedRealPassenger5['name'] = $validatedDataPassengers5['nama_penumpang_5'];
                    $validatedRealPassenger5['id_number'] = $validatedDataPassengers5['nik_penumpang_5'];
                    $validatedRealPassenger5['gender'] = $validatedDataPassengers5['jenis_penumpang_5'];
                    Passenger::create($validatedRealPassenger5);
                case 4:
                    $validatedRealPassenger4 = [];
                    $validatedRealPassenger4['order_id'] = $order2->id;
                    $validatedRealPassenger4['name'] = $validatedDataPassengers4['nama_penumpang_4'];
                    $validatedRealPassenger4['id_number'] = $validatedDataPassengers4['nik_penumpang_4'];
                    $validatedRealPassenger4['gender'] = $validatedDataPassengers4['jenis_penumpang_4'];
                    Passenger::create($validatedRealPassenger4);
                case 3:
                    $validatedRealPassenger3 = [];
                    $validatedRealPassenger3['order_id'] = $order2->id;
                    $validatedRealPassenger3['name'] = $validatedDataPassengers3['nama_penumpang_3'];
                    $validatedRealPassenger3['id_number'] = $validatedDataPassengers3['nik_penumpang_3'];
                    $validatedRealPassenger3['gender'] = $validatedDataPassengers3['jenis_penumpang_3'];
                    Passenger::create($validatedRealPassenger3);
                case 2:
                    $validatedRealPassenger2 = [];
                    $validatedRealPassenger2['order_id'] = $order2->id;
                    $validatedRealPassenger2['name'] = $validatedDataPassengers2['nama_penumpang_2'];
                    $validatedRealPassenger2['id_number'] = $validatedDataPassengers2['nik_penumpang_2'];
                    $validatedRealPassenger2['gender'] = $validatedDataPassengers2['jenis_penumpang_2'];
                    Passenger::create($validatedRealPassenger2);
                case 1:
                    $validatedRealPassenger1 = [];
                    $validatedRealPassenger1['order_id'] = $order2->id;
                    $validatedRealPassenger1['name'] = $validatedDataPassengers1['nama_penumpang_1'];
                    $validatedRealPassenger1['id_number'] = $validatedDataPassengers1['nik_penumpang_1'];
                    $validatedRealPassenger1['gender'] = $validatedDataPassengers1['jenis_penumpang_1'];
                    Passenger::create($validatedRealPassenger1);
            }
            ;
        }

        return redirect('/transactions')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(order $order)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(order $order)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\order  $order
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, order $order)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        $transaction = Transaction::where('order_id', $order->id)->first()->id;
        Transaction::destroy($transaction);

        $order->destroy($order->id);
        return redirect('/orders')->with('hapus', 'Data berhasil dihapus!');
    }

    public function checkprice(Request $request)
    {
        // if (!$request['travel'] || !$request['type'] || $request['pickup'] || $request['destination']) {
        //     return response()->json(['price' => "Select travel, type, Pickup, and Destination first"]);
        // }

        // Validasi ketersediaan value
        if (!$request['from_route']) {
            return response()->json(['price' => 'Pilih lokasi berangkat terlebih dahulu!']);
        } else {
            $from_route = $request['from_route'];
        }

        if (!$request['to_route']) {
            return response()->json(['price' => 'Pilih lokasi tujuan terlebih dahulu!']);
        } else {
            $to_route = $request['to_route'];
        }

        if (!$request['travel_id']) {
            return response()->json(['price' => 'Pilih travel terlebih dahulu!']);
        } else {
            $travel_id = $request['travel_id'];
        }

        if (!$request['type_id']) {
            return response()->json(['price' => 'Pilih kelas travel terlebih dahulu!']);
        } else {
            $type_id = $request['type_id'];
        }

        // Validasi rute sama
        if ($from_route == $to_route) {
            return response()->json(['price' => 'Anda tidak dapat memilih lokasi berangkat dan tujuan yang sama!']);
        }

        $track_id = track::where('from_route', $from_route)->where('to_route', $to_route)->first()->id;



        // Validasi belum jadi
        if ($track_id == null) {
            return response()->json(['price' => 'Harga tiket tidak dapat ditampilkan']);
        }

        $price = ticket::all()->where('travel_id', $travel_id)->where('type_id', $type_id)->where('track_id', $track_id)->first()->price->price;

        // Validasi belum jadi
        if ($price == null) {
            return response()->json(['price' => 'Harga tiket tidak dapat ditampilkan']);
        }

        // Return JSON
        return response()->json(['price' => $price]);
    }
}
