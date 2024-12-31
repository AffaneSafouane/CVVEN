<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestMailpit extends BaseController
{
    public function index() : string
    {
        return view('testMailpit');
    }
}