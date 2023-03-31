<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Message;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $id = Auth::id();
        
        $user = Message::where('receiver', $id)

                        ->orWhere('sender', $id)

                        ->get();
        $ids = [];

        foreach ($user as $key => $value) {
            // dd($value);

            if($value->sender != $id ){
                $ids[] = $value->sender;
            }

            if($value->receiver != $id){
                $ids[] = $value->receiver;
            }
            
            
        }

        $fId = array_unique($ids);
        // dd($fId );

        $fUser = User::whereIn('id', $fId)->get();
        $contact = Contact::where('user', $id)->pluck('contact');

        $userContact = User::whereIn('id', $contact)->get();
        // dd($fUser);
        return view('home')
                ->with('user', $fUser)
                
                ->with('contact', $userContact);

    }

    public function contactList()
    {   
        $id = Auth::id();
        
        $user = Message::where('receiver', $id)

                        ->orWhere('sender', $id)

                        ->get();
        // dd($user );
        return view('pages.contact_list')
                ->with('user', $user);

    }
}
