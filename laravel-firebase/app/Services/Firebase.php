<?php

namespace App\Services;
use Kreait\Firebase\Factory;

class Firebase {
  public $firebase;
  public function __construct()
  {
    $this->firebase = (new Factory)->withServiceAccount(base_path('firebase.json'));
  }
}