<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginSubmit(Request $request){
        //Form Validation
        $request->validate(
            //rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:8|max:32',
            ],
            // Error messages
            [
                'text_username.required' => 'O username é obrigatório',
                'text_username.email' => 'O username deve ser um email válido',
                'text_password.required' => 'O password é obrigatório',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres',
                'text_password.max' => 'O password deve ter pelo menos :max caracteres',
            ]
        );

        // get user input

        $username = $request->input('text_username');

        $password = $request->input('text_password');


        // Check if users exists
        $user = User::where('username', $username)
                ->where('deleted_at', NULL)
                ->first();

        if(!$user){
            return redirect()
            ->back()
            ->withInput()
            ->with('loginError', 'Username ou Password incorreto!');
        }

        //Check the Password is correct
        if(!password_verify($password, $user->password)){
            return redirect()
            ->back()
            ->withInput()
            ->with('loginError', 'Username ou Password incorreto!');
        }

        //Update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // Login user
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
            ]);

        // Redirect to home
        return redirect()->to('/');


    }

    public function logout(){
       // Logout from the application
       session()->forget('user');
       return redirect()->to('/login');
    }


}
