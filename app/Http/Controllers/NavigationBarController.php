<?php 

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;

class NavigationBarController extends Controller
{
    
    public function users()
    {
        try{
            $user = \Auth::user();
            
            return \Response::json($user);
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }
        
    }

    public function messages()
    {
        

        try{
            $messages = Message::orderBy('id', 'desc')->get(); 
           
            return \Response::json($messages);
        }
        catch(Exception $e)
        {
            $error = $e;
            return \Response::json($error);
        }

        
    }
}