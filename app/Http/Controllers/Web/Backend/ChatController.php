<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Namu\WireChat\Events\MessageCreated;
use Namu\WireChat\Events\NotifyParticipant;

class ChatController extends Controller
{
    public function index($id)
    {
        $myself = auth()->user();

        $otherUser = User::findOrFail($id);

        $users = User::where('id', '!=', $myself->id)->get();

        $conversations = $myself->conversations()->with(['participants' => function ($query) {
            $query->with('participantable:id,name,avatar')->where('participantable_id', '!=', auth()->id());
        }, 'lastMessage'])->latest('updated_at')->get();

        // return $conversations;

        return view('chat', compact('otherUser', 'users', 'conversations'));
    }

    public function send(Request $request, int $id)
    {
        $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $myself = auth()->user();

        $otherUser = User::findOrFail($id);

        $conversation = $myself->createConversationWith($otherUser);
        $conversation = $myself->sendMessageTo($otherUser, $request->message);

        broadcast(new MessageCreated($conversation));
        broadcast(new NotifyParticipant($otherUser, $conversation));
        return back();
    }
}
