<?php

namespace App\Controllers;

use App\Models\FasilitasModel;

class Fasilitas extends BaseController
{
    protected $fasilitasModel;
    public function __construct()
    {
        $this->fasilitasModel = new FasilitasModel();
    }
    public function index()
    {

        $fasilitasModel = $this->fasilitasModel->getFasilitas();

        $data = [
            'dataF' => $fasilitasModel,
            'title' => 'Data Master',
            'loc' => 'fasilitas',
            'subTitle' => 'Fasilitas'
        ];
        if (session()->get('role') == 1) {
            return view('fasilitas/index', $data);
        } else {
            return redirect()->to(base_url() . '/');
        }
    }

    public function update()
    {
        // dd($this->request->getVar());
        $this->fasilitasModel->save(
            [
                'idFasilitas' => $this->request->getVar('UidFasilitas'),
                'namaFasilitas' => $this->request->getVar('UnamaFasilitas')
            ]
        );

        session()->setFlashdata('pesanWarn', 'Fasilitas Berhasil Diubah');
        return redirect()->to('/fasilitas');
    }


    public function save()
    {
        // dd($this->request->getVar());

        $this->fasilitasModel->save(
            [
                'namaFasilitas' => $this->request->getVar('namaFasilitas')

            ]
        );

        session()->setFlashdata('pesan', 'Fasilitas Berhasil Ditambahkan');
        return redirect()->to('/fasilitas');
    }

    public function delete()
    {
        // dd($this->request->getVar());
        $id = $this->request->getVar('DidFasilitas');
        // dd($id); 

        $this->fasilitasModel->delete($id);
        session()->setFlashdata('pesanDel', 'Fasilitas Berhasil Dihapus');

        return redirect()->to('/fasilitas');
    }
}
