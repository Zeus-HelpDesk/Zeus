<?php

namespace App\Http\Controllers;

use App\Ticket;
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = \Cache::tags($request->user()->id . ':home')->remember($request->user()->id . ':home:open', 10, function () {
            return Ticket::whereUserId(\Auth::user()->id)
                ->whereCompletedAt(null)
                ->orderBy('created_at', 'DESC')
                ->get(['hash', 'description', 'updated_at']);
        });
        return view('home', ['open' => $tickets]);
    }
}
