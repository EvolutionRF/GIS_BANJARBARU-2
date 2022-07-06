<?php

namespace App\Controllers;

use App\Models\kodePosModel;

class kodePos extends BaseController
{
    protected $kodePosModel;
    public function __construct()
    {
        $this->kodePosModel = new kodePosModel();
    }
    public function index()
    {


        $kodePos = $this->kodePosModel->getKodePos();

        $data = [
            'dataK' => $kodePos,
            'title' => 'Data Master',
            'loc' => 'Kode',
            'subTitle' => 'Kode Pos'
        ];
        if (session()->get('role') == 1) {


            return view('kodePos/index', $data);
        } else {
            return redirect()->to(base_url() . '/');
        }
    }

    public function update()
    {
        // dd($this->request->getVar());
        $this->kodePosModel->save(
            [
                'idkodePos' => $this->request->getVar('idkodePos'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kota' => $this->request->getVar('kota'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kodePos' => $this->request->getVar('kodePos'),
                'latitude_kel' => $this->request->getVar('latitude'),
                'longitude_kel' => $this->request->getVar('longitude')
            ]
        );

        session()->setFlashdata('pesanWarn', 'Kode Pos Berhasil Diubah');
        return redirect()->to('/kode');
    }

    public function save()
    {
        // dd($this->request->getVar());
        $this->kodePosModel->save(
            [
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kota' => $this->request->getVar('kota'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kodePos' => $this->request->getVar('kodePos'),
                'latitude_kel' => $this->request->getVar('latitude'),
                'longitude_kel' => $this->request->getVar('longitude')
            ]
        );

        session()->setFlashdata('pesan', 'Kode Pos Berhasil Ditambahkan');
        return redirect()->to('/kode');
    }

    public function delete()
    {
        // dd($this->request->getVar());
        $id = $this->request->getVar('DidkodePos');
        // dd($id);

        $this->kodePosModel->delete($id);
        session()->setFlashdata('pesanDel', 'Kode Pos Berhasil Dihapus');

        return redirect()->to('/kode');
    }
}
