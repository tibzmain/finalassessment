<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function composeMessage(Request $request)
    {   
        $id = Auth::id();
      	

      	$save = Message::create([

      		'sender' => $id,
      		'receiver' => (int) $request->contact,
      		'messsage' => $request->message,
      	]);

      	return back();
        // dd($user );

       

    }

    public function getMessage(Request $request)
    {   
        $id = Auth::id();
        
        $contact = (int) $request->id;


        $arrayId = [$id,$contact];

        $name = User::where('id', $contact)->pluck('fname')->first();

        $message = Message::whereIn('sender', $arrayId)
                    ->whereIn('receiver', $arrayId)
                    ->get();

        return response()->json([
                'data' => $message,
                'name' => $name,
          
            ]);
        // dd($user );

       

    }

    public function sendMessage(Request $request)
    {   
        $id = Auth::id();
        
        $contact = (int) $request->id;
        
        $save = Message::create([

          'sender' => $id,
          'receiver' => $contact,
          'messsage' => $request->message,
        ]);

        if($save){
          return response()->json([
                'data' => 1,
          
          
            ]);
        }
        
        // dd($user );

       

    }
}
