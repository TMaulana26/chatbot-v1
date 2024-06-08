<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function createSession()
    {
        $session = ChatSession::create(['user_id' => Auth::id()]);
        return response()->json($session);
    }

    public function addMessage(Request $request)
    {
        $message = ChatMessage::create([
            'session_id' => $request->session_id,
            'message' => $request->message,
            'is_user' => $request->is_user,
        ]);

        return response()->json($message);
    }

    public function getSessionMessages($sessionId)
    {
        $messages = ChatMessage::where('session_id', $sessionId)->get();
        return response()->json($messages);
    }
}
