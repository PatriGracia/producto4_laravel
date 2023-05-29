<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function index () {
        // $user = Usuario::where('Username', 'Dave')->first();
        // return view('login.login', compact('user'));
        return view('auth.login');
    }
}