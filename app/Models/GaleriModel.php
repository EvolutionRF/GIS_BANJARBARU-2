<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{

    protected $table      = 'galeri';
    protected $primaryKey = 'idgaleri';
    protected $allowedFields = ['namafile', 'namaTable', 'id'];

    public function getGaleri($id = false, $tableG = false, $idDet = false)
    {
        if ($idDet == false and $tableG == false) {
            return $this->db->table('galeri')
                ->where('idgaleri', $id)
                ->get()->getResultArray();
        } else {
            $array = array('namaTable' => $tableG, 'id' => $idDet);
            return $this->db->table('galeri')
                ->where($array)
                ->get()->getResultArray();
        }
    }

    public function fotoUtama($id = false)
    {
        return $this->db->table('galeri')
            ->where('id', $id)->orderBy('id', 'DESC')
            ->get()->getFirstRow();
    }
}
