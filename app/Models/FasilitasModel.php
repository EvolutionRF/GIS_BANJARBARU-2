<?php

namespace App\Models;

use CodeIgniter\Model;

class FasilitasModel extends Model
{

    protected $table      = 'fasilitas';
    protected $primaryKey = 'idFasilitas';

    protected $allowedFields = ['namaFasilitas'];

    public function getFasilitas($id = false)
    {
        if ($id == false) {
            return $this->db->table('fasilitas')
                ->get()->getResultArray();
        } else {
            return $this->db->table('fasilitas')
                ->where('idfasilitas', $id)
                ->get()->getResultArray();
        }
    }
}
