<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;
use Kreait\Firebase\Database\Query\Filter\LimitToFirst;

class DatabaseController extends Controller
{
    protected $db;
    public function __construct()
    {
        $this->db = (new Firebase)->realtimeDatabase;
    }

    public function store(Request $request)
    {
        $ref = $this->db->getReference('users');

        // $ref->set([
        //     'status' => 'offline',
        //     'name' => 'john'
        // ]);

        $ref->push($request->all());

        return response()->json();
    }

    public function index()
    {
        $ref = $this->db->getReference('users');

        // $users = $ref->getValue();

        // Select only users with online status
        $users = $ref->orderByChild('status')->equalTo('online')->getValue();
        // $users = $ref->orderByChild('status')->equalTo('offline')->LimitToFirst(10)->getValue();
        // $users = $ref->orderByChild('status')->equalTo('offline')->LimitToLast(10)->getValue();
        // $users = $ref->orderByChild('age')->startAt(25)->LimitToLast(10)->getValue();
        // $users = $ref->orderByChild('age')->equalTo(25)->LimitToLast(10)->getValue();

        return response()->json(compact('users'));
    }

    public function update() 
    {
        $ref = $this->db->getReference('users');

        $user = $ref->orderByChild('id')->equalTo(1)->getValue();

        dd($user);

        $key = array_key_first($user);
        dd($key);
        
        $userRef = $this->db->getReference('users/'.$key.'/status');

        // $userRef->update([
        //     'status' => 'online'
        // ]);

        $userRef->set('offline');
        return response()->json();
    }
}
