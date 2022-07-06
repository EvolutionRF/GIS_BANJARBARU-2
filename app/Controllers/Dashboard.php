<?php

namespace App\Controllers;

use App\Models\WisataModel;
use App\Models\GaleriModel;
use App\Models\JamOperasionalModel;
use App\Models\kodePosModel;
use App\Models\JenisWisataModel;

class Dashboard extends BaseController
{

    protected $wisataModel, $jenisWisataModel, $galeriWModel, $kodePosModel, $jamOp;
    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->jenisWisataModel = new JenisWisataModel();
        $this->galeriWModel = new GaleriModel();
        $this->kodePosModel = new kodePosModel();
        $this->jamOp = new JamOperasionalModel();
    }
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $kodepos = $this->request->getVar('kodePos');

        if ($keyword || $kodepos) {
            $wisata = $this->wisataModel->search($keyword, $kodepos);
            $pager = "";
        } else {
            $wisata = $this->wisataModel->paginate(9, 'wisata');

            $pager = $this->wisataModel->pager;
        }

        $wisataX = $this->wisataModel->getWisata();
        $include = [
            'jenis' => $this->jenisWisataModel->getJenisWisata(),
            'kdPos' => $this->kodePosModel->getKodePos(),
            'jamOp' => $this->jamOp->getJam(),
        ];
        $le = $this->wisataModel->countAllResults();

        $as = [];
        // d($wisataX);

        foreach ($wisataX as $w) {
            $as[] = $this->galeriWModel->fotoUtama($w['idWisata']);
        }
        // d($as);

        $search = [
            'keyword' => $this->request->getVar('keyword'),
            'lokasi' => $this->request->getVar('kodePos')
        ];
        $data = [
            'search' => $search,
            'include' => $include,
            'fotoWisata' => $as,
            'dataW' => $wisata,
            'pager' => $pager,
            'title' => 'Dashboard',
            'loc' => 'Dashboard',
            'subTitle' => ''
        ];
        return view('v_dashboard', $data);
    }
}
