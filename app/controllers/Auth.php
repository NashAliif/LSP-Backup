<?php

class Auth extends Controller
{
    public function __construct()
    {
        $this->guest();
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer', $data);
    }

    public function login()
    {
        $logedIn = KasirModel::login($_POST);
        if ($logedIn) {
            header('Location: ' . BASEURL . '/master');
        } else {
            header('Location: ' . BASEURL . '/auth');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
    }
}