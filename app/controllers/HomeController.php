<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->view('/home/index');
    }

    public function seucarrinho()
    {

        $this->view('/home/seucarrinho/index');
    }
}
