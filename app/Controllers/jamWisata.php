<?php

namespace App\Controllers;

use App\Models\JamOperasionalModel;

class jamWisata extends BaseController
{
    protected $jamWisata;
    public function __construct()
    {
        $this->jamWisata = new JamOperasionalModel();
    }
    public function index()
    {

        $jam = $this->jamWisata->getJam();
        $data = [
            'jam' => $jam,
            'title' => 'Data Master',
            'loc' => 'jam',
            'subTitle' => 'Jam Operasional'
        ];
        return view('/jamWisata/index', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());

        $this->jamWisata->save(
            [
                'jamBuka' => $this->request->getVar('jamBuka'),
                'jamTutup' => $this->request->getVar('jamTutup'),

            ]
        );


        session()->setFlashdata('pesan', 'Jam Operasional Berhasil Ditambahkan');
        return redirect()->to('/jam');
    }

    public function update()
    {
        // dd($this->request->getVar());
        $this->jamWisata->save(
            [
                'idJam' => $this->request->getVar('Uidjam'),
                'jamBuka' => $this->request->getVar('UjamBuka'),
                'jamTutup' => $this->request->getVar('UjamTutup'),

            ]
        );

        session()->setFlashdata('pesan', 'Jam Operasional Berhasil DiUbah');
        return redirect()->to('/jam');
    }

    public function delete()
    {
        // dd($this->request->getVar());
        $id = $this->request->getVar('Didjam');
        // dd($id); 

        $this->jamWisata->delete($id);
        session()->setFlashdata('pesanDel', 'Jam Operasional Berhasil Dihapus');

        return redirect()->to('/jam');
    }
}
