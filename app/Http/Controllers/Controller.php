<?php

namespace App\Http\Controllers;

use App\Models\Auth\UserModel;
use App\Models\Schema\RiskModel;
use App\Models\Schema\SchemaModel;
use App\Models\Schema\UserCredentialModel;

abstract class Controller
{
   protected $user, $userCredential, $schema, $risk;

    public function __construct()
    {
        $this->user = new UserModel();   
        $this->userCredential = new UserCredentialModel();
        $this->schema = new SchemaModel();
        $this->risk = new RiskModel();
    }
}
