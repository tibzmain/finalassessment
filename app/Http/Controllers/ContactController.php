<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function searchUser(Request $request)
    {   
        $id = Auth::id();
        $name = $request->name;

        $contact = Contact::where('user', $id)->pluck('contact');
        $user = User::where('fname','LIKE', "%{$name}%")
        			->orWhere('lname', 'LIKE', "%{$name}%")
        			->whereNotIn('id', $contact )
        			->get();
        // dd($user );

        return response()->json([
                'data' => $user,
          
            ]);
    

    }

    public function fetchContact()
    {   
        $id = Auth::id();

        $contact = Contact::where('user', $id)->pluck('contact');

        $user = User::wherein('id', $contact)->get();

        // dd($user );

        return response()->json([
                'data' => $user,
          
            ]);
    

    }

    public function deleteContact(Request $request)
    {   
        $id = Auth::id();

        $del = Contact::where('user', $id)
        			->where('contact', (int) $request->id)
        			->delete();


        if($del){
        	return response()->json([
                'data' => 1,
          
            ]);
        }
        // dd($user );

        return response()->json([
                'data' => 0,
          
            ]);
    

    }

    public function addUser(Request $request)
    {   
        $id = Auth::id();

        $save = Contact::create([
        	'user' => $id,
        	'contact'	=> (int)$request->id
        ]);
        
        $code = 0;
        if($save){
        	return response()->json([
                'data' => 1,
          
            ]);
        }

        return response()->json([
                'data' => $user,
          
            ]);
    

    }
}
