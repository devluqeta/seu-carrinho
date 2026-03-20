<?php

require_once __DIR__ . '/../../models/seucarrinho/ListModel.php';

class CartController extends Controller
{
    public function index()
{
    AuthMiddleware::handle();

    $model = new ListModel();

    $user = $_SESSION['user'];
    $search = $_GET['search'] ?? null;

    $lists = $model->getByUser($user['id'], $search);

    $this->view('home/seucarrinho/home/index', compact('lists'));
}
}
