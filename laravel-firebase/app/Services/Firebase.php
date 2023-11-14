<?php

namespace App\Services;
use Kreait\Firebase\Factory;

class Firebase {
  public $firebase;
  public $auth;

  public function __construct()
  {
    $this->firebase = (new Factory)->withServiceAccount(base_path('firebase.json'));

    $this->auth = $this->firebase->createAuth();
    
  }
}