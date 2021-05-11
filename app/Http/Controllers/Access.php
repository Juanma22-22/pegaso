<?php

namespace App\Http\Access;

use Illuminate\Http\Request;

class AccessLogin 
{
    private $email;
    private $password;
    private $typeUser;


    public function __construct($email, $password, $typeUser)
    {
        $this->email = $email;
        $this->password = $password;
        $this->typeUser = $typeUser; 
    }

}
