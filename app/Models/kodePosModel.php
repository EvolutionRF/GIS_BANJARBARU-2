<?php

namespace App\Models;

use CodeIgniter\Model;

class kodePosModel extends Model
{

    protected $table      = 'kodepos';
    protected $primaryKey = 'idkodePos';
    protected $allowedFields = ['kelurahan', 'kecamatan', 'kodePos', 'latitude_kel', 'longitude_kel', 'kota'];
    public function getKodePos($id = false)
    {
        if ($id == false) {
            return $this->db->table('kodepos')
                ->get()->getResultArray();
        } else {
            return $this->db->table('kodepos')
                ->where('idkodePos', $id)
                ->get()->getResultArray();
        }
    }
}
