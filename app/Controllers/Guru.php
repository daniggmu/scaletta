<?php

namespace App\Controllers;

use App\Models\gurumodel; //model
use CodeIgniter\Controller;

class guru extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    public function __construct()
    {
        $this->model = new gurumodel();
    }

    public function index()
    {

        $data = [
            'judul' => 'Data Guru',
            'guru' => $this->model->getAllData() // variabel guru
        ];
        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('guru/index');
        echo view('templates/footer');
    }

    public function tambah()

    {
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nip' => 'required',
                'nama' => 'required'
            ]);

            // jika validasi gagal
            if (!$val) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('/guru'));
            }
            // jika berhasil
            else {
                $file = $this->request->getFile('gambar');
                $namaGambar = $file->getName();
                $file->move('./assets/img/');
                $id = $this->request->getPost('id');
                $data = [
                    'gambar' => $namaGambar,
                    'nip' => $this->request->getVar('nip'),
                    'nama' => $this->request->getVar('nama')
                ];

                //insert data
                $success = $this->model->tambah($data);
                //flash session
                if ($success) {
                    session()->setFlashdata('pesan', 'Ditambahkan.');
                    return redirect()->to(base_url('/guru'));
                }
            }
        } else { // jika tidak ada post dikirm maka akan kembali ke halaman guru
            return redirect()->to(base_url('/guru'));
        }
    }
    public function hapus($id)
    {
        $data = [
            'guru' => $this->model->getAllData($id)
        ];

        $success = $this->model->hapus($id);

        //hapus gambar yang di folder explorer
        // $img = $data['guru']['gambar'];
        // if ($img != 'default.jpg') {
        //     unlink(FCPATH . 'assets/img/' . $img);
        // }

        if ($success) {
            session()->setFlashdata('pesan', 'Dihapus.');
            return redirect()->to(base_url('/guru'));
        }
    }
    public function ubah()

    {


        if (isset($_POST['ubah'])) {
            $val = $this->validate([
                'nip' => 'required',
                'nama' => 'required'
            ]);
            // jika validasi gagal
            if (!$val) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('/guru'));
            }
            // jika berhasil
            else {
                // $file = $this->request->getFile('gambar');
                // $namaGambar = $file->getName();
                // $file->move('./assets/img/');
                $id = $this->request->getPost('id');
                $data = [
                    // 'gambar' => $namaGambar,
                    'nip' => $this->request->getVar('nip'),
                    'nama' => $this->request->getVar('nama')
                ];

                //update data
                $success = $this->model->ubah($data, $id);
                //flash session
                if ($success) {
                    session()->setFlashdata('pesan', 'Diubah.');
                    return redirect()->to(base_url('/guru'));
                }
            }
        } else { // jika tidak ada post dikirm maka akan kembali ke halaman siswa
            return redirect()->to(base_url('/guru'));
        }
    }
}
