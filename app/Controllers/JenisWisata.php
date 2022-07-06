<?php

namespace App\Controllers;

use App\Models\JenisWisataModel;

class JenisWisata extends BaseController
{
    protected $jenisWisataModel;
    public function __construct()
    {
        $this->jenisWisataModel = new JenisWisataModel();
    }
    public function index()
    {


        $jenisWisata = $this->jenisWisataModel->getJenisWisata();

        $data = [
            'dataK' => $jenisWisata,
            'title' => 'Data Master',
            'loc' => 'Jenis',
            'subTitle' => 'Jenis Wisata'
        ];
        if (session()->get('role') == 1) {


            return view('JenisWisata/index', $data);
        } else {
            return redirect()->to(base_url() . '/');
        }
    }

    public function update()
    {
        // dd($this->request->getVar());
        $this->jenisWisataModel->save(
            [
                'idjenisWisata' => $this->request->getVar('UidJenisWisata'),
                'namaJenisWisata' => $this->request->getVar('UnamaJenisWisata'),
                'keteranganJW' => $this->request->getVar('UKeteranganJW'),
            ]
        );

        session()->setFlashdata('pesanWarn', 'Jenis Wisata Berhasil Diubah');
        return redirect()->to('/jenis');
    }

    public function save()
    {
        // dd($this->request->getVar());

        $this->jenisWisataModel->save(
            [
                'namaJenisWisata' => $this->request->getVar('jenisWisata'),
                'keteranganJW' => $this->request->getVar('keteranganJW'),

            ]
        );

        session()->setFlashdata('pesan', 'Jenis Wisata Berhasil Ditambahkan');
        return redirect()->to('/jenis');
    }

    public function delete()
    {
        // dd($this->request->getVar());
        $id = $this->request->getVar('DidJenisWisata');
        // dd($id); 

        $this->jenisWisataModel->delete($id);
        session()->setFlashdata('pesanDel', 'Jenis Wisata Berhasil Dihapus');

        return redirect()->to('/jenis');
    }
}
