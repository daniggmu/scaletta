<?php

namespace App\Models;

use CodeIgniter\Model;


class prodimodel extends Model
{

    protected $table      = 'prodi';
    protected $primaryKey = 'id';
    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $allowedField         = ['namaprodi', 'jenjang', 'ukt'];



    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->builder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('prodi')->get();
        } else {
            $this->db->table('prodi')->where('id', $id);
            return $this->db->table('prodi')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('prodi')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('prodi')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('prodi')->update($data, ['id' => $id]);
    }
}
