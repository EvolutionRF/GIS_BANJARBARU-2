<?php

namespace App\Controllers;

use App\Models\WisataModel;
use App\Models\GaleriModel;
use App\Models\kodePosModel;
use App\Models\JenisWisataModel;

class Maps extends BaseController
{
    protected $wisataModel, $jenisWisataModel, $galeriWModel, $kodePosModel;
    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->jenisWisataModel = new JenisWisataModel();
        $this->galeriWModel = new GaleriModel();
        $this->kodePosModel = new kodePosModel();
    }
    public function index()
    {
        $wisata = $this->wisataModel->getWisata();
        $le = $this->wisataModel->countAllResults();
        // dd($le);
        // dd($ga->namafile);
        $as = [];

        foreach ($wisata as $w) {
            $as[] = $this->galeriWModel->fotoUtama($w['idWisata']);
        }

        $data = [
            'fotoWisata' => $as,
            'wisata' => $wisata,
            'title' => 'Maps',
            'loc' => 'Maps',
            'subTitle' => ''
        ];
        return view('Maps/index', $data);
    }
}
