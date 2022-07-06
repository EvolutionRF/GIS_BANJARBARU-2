<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisWisataModel extends Model
{

    protected $table      = 'jeniswisata';
    protected $primaryKey = 'idjenisWisata';

    protected $allowedFields = ['namaJenisWisata', 'keteranganJW'];

    public function getJenisWisata($id = false)
    {
        if ($id == false) {
            return $this->db->table('jeniswisata')
                ->get()->getResultArray();
        } else {
            return $this->db->table('jeniswisata')
                ->where('idjenisWisata', $id)
                ->get()->getResultArray();
        }
    }
}
