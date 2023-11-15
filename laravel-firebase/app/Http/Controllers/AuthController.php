<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $auth;


    public function __construct()
    {
        $this->auth = (new Firebase)->auth;
    }

    public function register(Request $request)
    {
        $this->auth->createUser([
            "email" => $request->email,
            "password" => $request->password,
        ]);
    }

    public function login(Request $request)
    {
        $user = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
        return response()->json(['msg'=> 'Logged In', 'user'=> $user->data()]);
    }

    public function update(Request $request) {
        $this->auth->updateUser('mMfKzU6mlYPG9jEDjlWhdYCaErT2', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json(['msg'=> 'User Updated']);
    }

    public function disable()
    {
        $this->auth->disableUser('mMfKzU6mlYPG9jEDjlWhdYCaErT2');
        return response()->json(['msg' => 'User Disabled']);
    }

    public function enable()
    {
        $this->auth->enableUser('mMfKzU6mlYPG9jEDjlWhdYCaErT2');
        return response()->json(['msg' => 'User Enabled']);
    }

    public function index()
    {
        return response()->json('');
    }
}
