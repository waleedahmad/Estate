<?php

namespace App\Http\Controllers;

use App\Layout;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getContactForm(){
        switch(Layout::find(4)->layout_name){
            case 'Contact':
                return view('contact.simple');
            case 'Contact Wide':
                return view('contact.wide');
        }
    }

    public function sendEmail(Request $request){
        $validator = \Validator::make($request->all(), [
            'contactName'   =>  'required',
            'email' =>  'required|email',
            'comments'  =>  'required'
        ]);

        if($validator->passes()){
            return redirect('/contact')->with('message', 'Your message has been sent.');
        }else{
            return redirect('/contact')->withErrors($validator)->withInput();
        }
    }
}
