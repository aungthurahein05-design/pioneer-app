<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

     public function index(){
        return view('contact');   // resources/views/contact.blade.php
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required',
        ]);

        // DB ထဲသိမ်းချင်ရင်
        // Contact::create($request->all());

        // Email ပို့ချင်ရင် Mail::to(...) သုံးနိုင်
        return back()->with('success','Your message has been sent!');
    }
}
