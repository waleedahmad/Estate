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
}
