<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Message;
use App\Events\Chat\RealtimeMessage;


class MessageController extends Controller
{
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function index()
    {
        $user = \Auth::user();

        return Inertia::render('Messages/messageComponent', [
            'user' => $user,
        ]);
        
    }
    public function send(Request $request)
    {
       
        try{
           $user = User::first();
            
            $message = Message::create([
               
                'body' => $request->body,
            ]);
            RealtimeMessage::dispatch($message);
            $user->notify(new \App\Notifications\MessageNotification($message));
            $response = true;
            return \Response::json($response);  
           
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
        
    }

    public function load($id)
    {
        $load_messages = Message::findOrFail($id);
        return Inertia::render('Messages/MessageComponent', [
            'load_messages' => $load_messages,
        ]);
    }
}