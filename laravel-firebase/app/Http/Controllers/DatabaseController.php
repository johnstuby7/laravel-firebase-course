<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    protected $db;
    public function __construct()
    {
        $this->db = (new Firebase)->realtimeDatabase;
    }
}
