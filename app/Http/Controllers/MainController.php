<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        // load user´s notes

        // Show home view
        $notes = [];
        return view('home', ['notes' => $notes]);
    }

    public function newNote(){
        echo "I'm create a new note";
    }

}
