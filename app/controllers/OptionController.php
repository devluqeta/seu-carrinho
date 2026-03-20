<?php

class OptionController extends Controller
{
    public function __construct()
    {
        AuthMiddleware::handle();
    }

    public function index()
    {
        $this->view('option/index');
    }
}
