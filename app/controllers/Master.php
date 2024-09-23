<?php

class Master extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('Master/index');
        $this->view('templates/footer');
    }
}