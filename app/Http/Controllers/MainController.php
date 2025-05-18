<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index(){
        // load user´s notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->whereNull('deleted_at')->get()->toArray();

        // Show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote(){
        // Show new note view
        return view('new_note');
    }

    public function newNoteSubmit(Request $request){

        // Validate request
        $request->validate(
            // Rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],

            // error messages
            [
                'text_title.required' => 'O título é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres',
            ]

        );

        // get user id
        $id = session('user.id');

        // create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;

        $note->save();

        // redirect to home
        return redirect()->route('home');

    }

    public function editNote($id){

        $id = Operations::decryptId($id);
        if($id === null){
            return redirect()->route('home');
        }

        // Load note
        $note = Note::find($id);

        // Show edit note view
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request){

        // Validate request
        $request->validate(
            // Rules
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000',
            ],
            // Error messages
            [
                'text_title.required' => 'O titulo é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no máximo :max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres',
            ]
        );

        // Check if notes exists
        if($request->note_id == null){
            die('erro');
            return redirect()->route('home');
        }

        // decrypt note_id
        $id = Operations::decryptId($request->note_id);
        if($id === null){
            return redirect()->route('home');
        }

        // Load note
        $note = Note::find($id);

        // Update note
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        // Redirect home
        return redirect()->route('home');
    }

    public function deleteNote($id){

        $id = Operations::decryptId($id);
        if($id === null){
            return redirect()->route('home');
        }

        // Load note
        $note = Note::find($id);

        // Show delete note confirmation
        return view('delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id){
        // Check if $id is encrypted
        $id = Operations::decryptId($id);
        if($id === null){
            return redirect()->route('home');
        }

        // Load note
        $note = Note::find($id);

        // 1. Hard delete
        //$note->delete();

        // 2. Soft Delete
        $note->deleted_at = date('Y:m:d H:i:s');
        $note->save();

        // Redirect to home
        return redirect()->route('home');

    }

}
