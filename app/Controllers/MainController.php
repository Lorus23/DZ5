<?php

namespace App\Controllers;
use App\View;


class MainController
{
    protected $view;
    public function __construct()
    {
        $this->view = new View();
    }
}