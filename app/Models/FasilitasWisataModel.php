<?php

namespace App\Models;

use CodeIgniter\Model;

class FasilitasWisataModel extends Model
{

    protected $table      = 'fasilitas_wisata';
    protected $primaryKey = 'id_fasilitas_wisata';

    protected $allowedFields = ['idFasilitas', 'idWisata', 'keteranganF'];

    public function getFasilitasWisata($idFw = false, $idWisata = false)
    {
        if ($idWisata == false) {
            return $this->db->table('fasilitas_wisata')
                ->where('idFasilitas', $idFw)
                ->get()->getResultArray();
        } else {
            $array = array('idWisata' => $idWisata);
            return $this->db->table('fasilitas_wisata')
                ->join('fasilitas', 'fasilitas_wisata.idFasilitas = fasilitas.idFasilitas')
                ->where($array)
                ->get()->getResultArray();
        }
    }
}
