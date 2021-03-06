<?php

namespace App\Http\Controllers\HelpDesk\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Ticket;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function insert(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'comment' => 'required|string'
        ]);
        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => Auth::user()->id,
            'ticket_id' => $ticket->id
        ]);
        if ($request->ajax()) {
            return response()->json($comment);
        } else {
            return redirect()->back();
        }
    }

    public function edit(Request $request, Ticket $ticket, Comment $comment)
    {
        return view();
    }

    public function update(Request $request, Ticket $ticket, Comment $comment)
    {
        tap($comment)->update($request->only(['comment']));
        if ($request->ajax()) {
            return response()->json($comment);
        } else {
            return redirect()->back();
        }
    }
}
