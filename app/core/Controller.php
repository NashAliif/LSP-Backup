<?php

class Controller
{
    public function view($view, $data = [])
    {
        include_once '../app/views/' . $view . '.php';
    }

    public function auth()
    {
        session_start();
        if (!isset($_SESSION['id_kasir'])) {
            header('Location: ' . BASEURL . '/auth');
        }
    }

    public function guest()
    {
        session_start();
        if (isset($_SESSION['id_kasir'])) {
            header('Location: ' . BASEURL . '/master');
        }
    }
}