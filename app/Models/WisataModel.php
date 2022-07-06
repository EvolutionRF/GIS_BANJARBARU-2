<?php

namespace App\Models;

use CodeIgniter\Model;

class WisataModel extends Model
{

    protected $table      = 'wisata';
    protected $primaryKey = 'idWisata';
    protected $allowedFields = ['namaWisata', 'cpWisata', 'alamatWisata', 'latWisata', 'longWisata', 'keterangan', 'deskripsiW', 'idjenisWisata', 'idkodePos', 'idJam'];

    public function getWisata($id = false)
    {
        if ($id == false) {
            return $this->db->table('wisata')
                ->join('jeniswisata', 'wisata.idjenisWisata = jenisWisata.idjenisWisata')->join('kodepos', 'wisata.idkodePos = kodepos.idkodePos')
                ->join('jamoperasional', 'wisata.idJam = jamoperasional.idJam')->orderBy('idWisata', 'ASC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('wisata')
                ->join('jeniswisata', 'wisata.idjenisWisata = jenisWisata.idjenisWisata')
                ->join('kodepos', 'wisata.idkodePos = kodepos.idkodePos')
                ->join('jamoperasional', 'wisata.idJam = jamoperasional.idJam')
                ->where('idWisata', $id)
                ->get()->getResultArray();
        }
    }

    public function getWisatabyName($name = false)
    {
        return $this->db->table('wisata')->where('namaWisata', $name)->get()->getResultArray();
    }

    public function search($keyword = false, $kodePos = false)
    {

        if ($keyword == false) {

            return $this->db->table('wisata')->LIKE('idkodePos', $kodePos)->get()->getResultArray();
        } elseif ($kodePos == false) {
            return $this->db->table('wisata')->LIKE('namaWisata', $keyword)->get()->getResultArray();
        } else {
            return $this->db->table('wisata')->LIKE('namaWisata', $keyword)->LIKE('idkodePos', $kodePos)->get()->getResultArray();
        }

        // 
    }
}
