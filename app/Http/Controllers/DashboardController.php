<?php

namespace App\Http\Controllers;

use App\Models\ticket;
use App\Models\order;
use App\Models\transaction;
use App\Models\Complaint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            return view('dashboard.index', [
                'tickets' => ticket::all(),
                'orders' => order::all(),
                'transactions' => transaction::where('status', false),
                'complaints' => complaint::where('seen', false)
            ]);
        } else {
            return view('dashboard.index', [
                'tickets' => ticket::all(),
                'orders' => order::all(),
                'transactions' => transaction::where('status', false)->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get(),
                'complaints' => complaint::where('seenForAdmin', false)->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get(),
            ]);
        }
    }
}