<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use App\Models\Donator;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:print report');
    }

    public function index()
    {
        $coins = Coins::all();
        // $coins = Coins::with('donators');
        // $coins = Coins::with('users');
        return view('print_report.report', ['coins' => $coins]);
    }
}
