<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;

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
}
