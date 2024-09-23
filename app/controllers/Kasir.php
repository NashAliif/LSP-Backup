<?php

class Kasir extends Controller
{

    public function __construct()
    {
        $this->auth();
    }

    public function index()
    {
        $data['title'] = 'Manage Kasir';
        $data['kasir'] = !empty(trim($_POST['keyword'] ?? '')) ? KasirModel::search($_POST) : KasirModel::getAllKasir();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('Kasir/index', $data);
        $this->view('templates/footer');
    }

    public function profile($id)
    {
        $data['title'] = 'Profile Kasir';
        $data['Kasir'] = KasirModel::getKasirById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kasir/profile', $data);
        $this->view('templates/footer');
    }

    public function addKasir()
    {
        $data['title'] = 'Create Kasir';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kasir/add-kasir', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $registered = KasirModel::register($_POST);
        if ($registered) {
            header('Location: ' . BASEURL . '/kasir');
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            header('Location: ' . BASEURL . '/kasir/addkasir');
            Flasher::setFlash('berhasil', 'ditambahkan', 'danger');
        }
    }

    public function update()
    {
        $updated = KasirModel::updateKasir($_POST);
        if ($updated) {
            header('Location: ' . BASEURL . '/kasir');
            Flasher::setFlash('berhasil', 'diupdate', 'success');
        }
        header('Location: ' . BASEURL . '/kasir');
        Flasher::setFlash('berhasil', 'diupdate', 'danger');
    }

    public function delete($id)
    {
        $deleted = KasirModel::deleteKasir($id);
        if ($deleted) {
            header('Location: ' . BASEURL . '/kasir');
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        }
        header('Location: ' . BASEURL . '/kasir');
        Flasher::setFlash('berhasil', 'dihapu', 'danger');
    }
}