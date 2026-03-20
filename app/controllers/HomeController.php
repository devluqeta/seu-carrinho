<?php

class HomeController extends Controller
{
    public function index()
    {
        AuthMiddleware::handle();

        $listModel = new ListModel();
        $lists = $listModel->getUserListsWithShared($_SESSION['user']['id']);

        $notificationModel = new NotificationModel();
        $notifications = $notificationModel->getByUser($_SESSION['user']['id']);

        $this->view('home/index', compact('lists', 'notifications'));
    }
}
