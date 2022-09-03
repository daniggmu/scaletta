<?php

namespace App\Models;

use CodeIgniter\Model;


class siswamodel extends Model
{

    protected $table      = 'siswa';
    protected $primaryKey = 'id';

    // Dates
    protected $useTimeStamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $allowedField         = ['gambar', 'nama', 'nim'];

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->builder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('siswa')->get();
        } else {
            $this->db->table('siswa')->where('id', $id);
            return $this->db->table('siswa')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('siswa')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('siswa')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('siswa')->update($data, ['id' => $id]);
    }
}
