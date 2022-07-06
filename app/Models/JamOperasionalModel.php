<?php

namespace App\Models;

use CodeIgniter\Model;

class JamOperasionalModel extends Model
{

    protected $table      = 'jamoperasional';
    protected $primaryKey = 'idJam';
    protected $allowedFields = ['jamBuka', 'jamTutup'];
    public function getJam($id = false)
    {
        if ($id == false) {
            return $this->db->table('jamoperasional')
                ->get()->getResultArray();
        } else {
            return $this->db->table('jamoperasional')
                ->where('idJam', $id)
                ->get()->getResultArray();
        }
    }
}
