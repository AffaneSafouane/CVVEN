<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = ["title" => 'Accueil'];
        return view('home/index', $data);
    }
}
