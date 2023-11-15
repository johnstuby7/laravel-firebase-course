<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth\UserQuery;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Log;

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
        // $users = $this->auth->listUsers();
        // $users = collect($users);

        // $query = UserQuery::all()->withOffset(1)->withLimit(100)->sortedBy(UserQuery::FIELD_CREATED_AT);
        // $users = $this->auth->queryUsers($query);

        $users = $this->auth->getUsers(['mMfKzU6mlYPG9jEDjlWhdYCaErT2','2','3']);
        return response()->json(compact('users'));
    }

    public function show(Request $request)
    {
        // $user = $this->auth->getUser($request->uid);
        
        try {
            $user = $this->auth->getUserByEmail($request->email);
        } catch (UserNotFound $th) {
            Log::info($th->getMessage());
            abort(404);
        }

        return response()->json(compact('user'));
    }

    public function delete()
    {
        // $user = $this->auth->deleteUser('mMfKzU6mlYPG9jEDjlWhdYCaErT2');
        $user = $this->auth->deleteUsers(['mMfKzU6mlYPG9jEDjlWhdYCaErT2', ''],true);
        return response()->json([], 204);
    }
}
