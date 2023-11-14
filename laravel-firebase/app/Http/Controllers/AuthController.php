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
}
