<?php

namespace App\Http\Controllers\HelpDesk\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use Cache;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request, Ticket $ticket)
    {
        return view('ticket.view', ['ticket' => $ticket]);
    }

    public function create(Request $request)
    {
        $categories = Cache::tags('category')->remember('category.all', now()->addHour(1), function () {
            return Category::all();
        });
        $priorities = Cache::tags('priority')->remember('priority.all', now()->addHour(1), function () {
            return Priority::all();
        });
        return view('ticket.create', ['categories' => $categories, 'priorities' => $priorities]);
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
        ]);
        // If a user is specified in the form use that otherwise default to the user that created the ticket
        $user = User::whereId($request->input('user_id'))->first() ?? Auth::user();
        $ticket = Ticket::create([
            'description' => $request->input('description'),
            'priority_id' => $request->input('priority_id'),
            'category_id' => $request->input('category_id'),
            'user_id' => $user->id,
            'room' => $user->room,
            'district_id' => $user->district->id,
            'building_id' => $user->building->id
        ]);
        Cache::tags('tickets')->clear();
        return redirect("/ticket/$ticket->hash");
    }

    public function edit(Request $request, Ticket $ticket)
    {
        return view('ticket.edit', ['ticket' => $ticket]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'description' => 'required|string',
            'priority_id' => 'required|exist:priorities,id',
            'category_id' => 'required|exist:categories,id',
        ]);
        tap($ticket)->update($request->only(['description', 'priority', 'category']));
        return redirect("/ticket/$ticket->hash");
    }
}
