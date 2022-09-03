<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run()
    {
        [
            $data = [
                [
                    'nama'           => 'dani',
                    'nip'            => '255555',
                    'alamat'         => 'tulungagung',
                    'created_at'     => Time::now(),
                    'updated_at'     => Time::now()
                ],
                [
                    'nama'           => 'rey',
                    'nip'            => '255555',
                    'alamat'         => 'tulungagung',
                    'created_at'     => Time::now(),
                    'updated_at'     => Time::now()
                ]
            ]
        ];

        // Simple Queries
        // // $this->db->query(
        //     "INSERT INTO daftarpeminjam (id_peminjam, nama, alamat, created_at, updated_at) VALUES(:id_peminjam:, :nama:, :alamat:, :created_at:, :updated_at:)", 
        //     $data
        // );

        // Using Query Builder
        $this->db->table('guru')->insertBatch($data);
    }
}
