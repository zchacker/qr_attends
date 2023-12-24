<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $basicStorage; // Define a protected variable
    
    public function __construct()
    {
        // Initialize the protected variable in the constructor
        $this->basicStorage = 'public';// 'public , contabo'; // this is shared for all file dirvers
    }
    
}
