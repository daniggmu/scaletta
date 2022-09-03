<?php

namespace App\Models;

use CodeIgniter\Model;


class gurumodel extends Model
{

    protected $table      = 'guru';
    protected $primaryKey = 'id';
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $allowedField         = ['gambar', 'nama', 'nip'];

    // public function __construct()
    // {
    //     $this->db = db_connect();
    //     $this->builder = $this->db->table($this->table);
    // }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('guru')->get();
        } else {
            $this->db->table('guru')->where('id', $id);
            return $this->db->table('guru')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('guru')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('guru')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('guru')->update($data, ['id' => $id]);
    }
}
