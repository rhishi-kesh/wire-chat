<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($id)
    {
        $myself = auth()->user();

        $user = User::findOrFail($id);

        $users = User::where('id', '!=', $myself->id)->get();

        return view('chat', compact('user', 'users'));
    }

    public function send(Request $request, int $id)
    {
        $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $myself = auth()->user();

        $otherUser = User::findOrFail($id);

        $conversation = $myself->sendMessageTo($otherUser, $request->message);
        return back();
    }
}
