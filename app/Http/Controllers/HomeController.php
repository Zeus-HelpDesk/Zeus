<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->user()->staff) {
            $tickets = Cache::tags(['tickets', 'staff:home'])
                ->remember("staff:home:open", now()->addMinute(10), function () {
                    return Ticket::whereCompletedAt(null)
                        ->orderBy('created_at', 'DESC')
                        ->with('building')
                        ->get(['hash', 'description', 'updated_at', 'building_id']);
                });
        } else {
            $tickets = Cache::tags([$request->user()->id . ':home', 'tickets'])
                ->remember($request->user()->id . ':home:open', now()->addMinute(10), function () {
                    return Ticket::whereUserId(Auth::user()->id)
                        ->whereCompletedAt(null)
                        ->orderBy('created_at', 'DESC')
                        ->with('building')
                        ->get(['hash', 'description', 'updated_at', 'building_id']);
                });
        }
        return view('home', ['open' => $tickets]);
    }
}
