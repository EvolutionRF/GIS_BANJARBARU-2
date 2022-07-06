<?php

namespace App\Controllers;

use App\Models\WisataModel;
use App\Models\GaleriModel;
use App\Models\kodePosModel;
use App\Models\JenisWisataModel;

class userFitur extends BaseController
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
        // dd($le);
        // dd($ga->namafile);

        $data = [
            'wisata' => $wisata,
            'title' => 'User Fitur',
            'loc' => 'User',
            'subTitle' => ''
        ];
        return view('User Fitur/start', $data);
    }

    public function Test()
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
            'title' => 'User Fitur',
            'loc' => 'User',
            'subTitle' => ''
        ];
        return view('User Fitur/index', $data);
    }

    public function proses()
    {
        // $wisata = $this->wisataModel->getWisata();
        // dd($this->request->getVar());
        $Latawal = $this->request->getVar('latitude');
        $Lngawal = $this->request->getVar('longitude');
        $objek = $this->request->getVar('jumlah');
        $rek[0] = [
            $Latawal, $Lngawal
        ];
        // dd($rek[0]);
        for ($x = 1; $x <= $objek; $x++) {
            $rek[$x] =  $this->wisataModel->getWisata($this->request->getVar('wisata-' . $x));
        };
        // dd($rek);
        $startIndex =  $this->request->getVar('startIndex');
        $totalCities = $this->request->getVar('totalCities');
        $maxIter = $this->request->getVar('maxIter');
        $data = [
            'path' => 'proses.php#!/totalCities=' . $totalCities . '&startIndex=' . $startIndex . '&maxIter=' . $maxIter,
            'objek' => $rek,
            'jumlahW' => $objek,
            'title' => 'User Fitur',
            'loc' => 'User',
            'subTitle' => ''
        ];
        return view('User Fitur/hasil', $data);
    }
}
