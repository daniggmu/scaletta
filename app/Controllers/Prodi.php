<?php

namespace App\Controllers;

use App\Models\prodimodel; //model
use CodeIgniter\Controller;

class prodi extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */

    public function __construct()
    {
        $this->model = new prodimodel();
        // $this->pager = \Config\Services::pager();
    }

    public function index()
    {

        $data = [
            'judul' => 'Data Prodi',
            'prodi' => $this->model->getAllData() // variabel prodi
            // 'prodi' => $this->model->paginate(10, 'prodi'),
            // 'pager' => $this->model->pager 
        ];
        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('prodi/index');
        echo view('templates/footer');
    }

    public function tambah()

    {
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'namaprodi' => 'required',
                'jenjang' => 'required',
                'ukt' => 'required'
            ]);
            // jika validasi gagal
            if (!$val) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('/prodi'));
            }
            // jika berhasil
            else {
                $data = [
                    'namaprodi' => $this->request->getVar('namaprodi'),
                    'jenjang' => $this->request->getVar('jenjang'),
                    'ukt' => $this->request->getVar('ukt')
                ];

                //insert data
                $success = $this->model->tambah($data);
                //flash session
                if ($success) {
                    session()->setFlashdata('pesan', 'Ditambahkan.');
                    return redirect()->to(base_url('/prodi'));
                }
            }
        } else { // jika tidak ada post dikirm maka akan kembali ke halaman prodi
            return redirect()->to(base_url('/prodi'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('pesan', 'Dihapus.');
            return redirect()->to(base_url('/prodi'));
        }
    }
    public function ubah()

    {
        if (isset($_POST['ubah'])) {
            $val = $this->validate([
                'namaprodi' => 'required',
                'jenjang' => 'required',
                'ukt' => 'required'
            ]);
            // jika validasi gagal
            if (!$val) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('/prodi'));
            }
            // jika berhasil
            else {
                $id = $this->request->getPost('id');
                $data = [
                    'namaprodi' => $this->request->getVar('namaprodi'),
                    'jenjang' => $this->request->getVar('jenjang'),
                    'ukt' => $this->request->getVar('ukt')
                ];

                //update data
                $success = $this->model->ubah($data, $id);
                //flash session
                if ($success) {
                    session()->setFlashdata('pesan', 'Diubah.');
                    return redirect()->to(base_url('/prodi'));
                }
            }
        } else { // jika tidak ada post dikirm maka akan kembali ke halaman prodi
            return redirect()->to(base_url('/prodi'));
        }
    }
}
