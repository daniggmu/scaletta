<?php

namespace App\Controllers;

use App\Models\siswamodel; //model
use CodeIgniter\Controller;

class siswa extends BaseController
{

    public function __construct()
    {

        $this->model = new siswamodel();
        // $this->pager = \Config\Services::pager();
    }

    public function index()
    {

        $data = [
            'judul' => 'Data Siswa', //title
            'siswa' => $this->model->getAllData() // variabel siswa
            // 'siswa' => $this->model->paginate(10, 'siswa'),
            // 'pager' => $this->model->pager 
        ];
        echo view('templates/header', $data);
        echo view('templates/sidebar');
        echo view('templates/topbar');
        echo view('siswa/index');
        echo view('templates/footer');
    }

    public function tambah()

    {
        // validasi
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'nim' => 'required', // harus ada value nim
                'nama' => 'required' // harus ada value nama
            ]);
            // jika validasi gagal
            if (!$val) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('/siswa'));
            }
            // jika berhasil
            else {
                $file = $this->request->getFile('gambar');
                $namaGambar = $file->getName();
                $file->move('./assets/img/');
                $id = $this->request->getPost('id');
                $data = [
                    'gambar' => $namaGambar,
                    'nim' => $this->request->getVar('nim'),
                    'nama' => $this->request->getVar('nama')
                ];

                //insert data
                $success = $this->model->tambah($data);
                //flash session
                if ($success) {
                    session()->setFlashdata('pesan', 'Ditambahkan.');
                    return redirect()->to(base_url('/siswa'));
                }
            }
        } else { // jika tidak ada post dikirm maka akan kembali ke halaman siswa
            return redirect()->to(base_url('/siswa'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);

        //  hapus gambar yang di folder explorer
        // $img = $data['guru']['gambar'];
        // if ($img != 'default.jpg') {
        //     unlink(FCPATH . 'assets/img/' . $img);
        // }

        if ($success) {
            session()->setFlashdata('pesan', 'Dihapus.');
            return redirect()->to(base_url('/siswa'));
        }
    }
    public function ubah()

    {
        if (isset($_POST['ubah'])) {
            $val = $this->validate([
                'nim' => 'required',
                'nama' => 'required'
            ]);
            // jika validasi gagal
            if (!$val) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('/siswa'));
            }
            // jika berhasil
            else {
                // $file = $this->request->getFile('gambar');
                // // nama gambar
                // $namaGambar = $file->getName();
                // //letak gambar
                // $file->move('./assets/img/');
                $id = $this->request->getPost('id');
                $data = [
                    // 'gambar' => $namaGambar,
                    'nim' => $this->request->getVar('nim'),
                    'nama' => $this->request->getVar('nama')
                ];

                //update data
                $success = $this->model->ubah($data, $id);
                //flash session
                if ($success) {
                    session()->setFlashdata('pesan', 'Diubah.');
                    return redirect()->to(base_url('/siswa'));
                }
            }
        } else { // jika tidak ada post dikirm maka akan kembali ke halaman siswa
            return redirect()->to(base_url('/siswa'));
        }
    }
}
