<?php 

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReplyMessage;
use App\Models\Message;
use App\Events\RealTimeReplyMessage;

class ReplyMessageController extends Controller
{
    private $reply;

    public function __construct(ReplyMessage $reply)
    {
        $this->reply = $reply;
    }
    public function index()
    {
        $messages = Message::all();
        return Inertia::render('ReplyMessages/ReplyMessageComponent', [
            'messages' => $messages,
        ]);
    }
    public function send(Request $request, $id)
    {
        $data = $request->all();
        $message = Message::findOrNew($id);
        $user = \Auth::user();

        try{
            $reply = Replymessage::create([
                'id_user' => $user->id,
                'id_message' => $message->id,
                'body' => $request->body,
            ]);
            
            RealTimeReplyMessage::dispatch($reply);
            //broadcast(new RealTimeReplyMessage($reply));
            $response = true;
            return true;
        }
        catch(Exception $e){
            $error = $e;
            return \Response::json($error);
        }
    }
}
