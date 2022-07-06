<?php

namespace App\Controllers;

use App\Models\FasilitasModel;
use App\Models\FasilitasWisataModel;
use App\Models\WisataModel;
use App\Models\GaleriModel;
use App\Models\JamOperasionalModel;
use App\Models\kodePosModel;
use App\Models\JenisWisataModel;

class Wisata extends BaseController
{
    protected $wisataModel, $jenisWisataModel, $galeriWModel, $kodePosModel, $jamWisata, $fasilitasWisataModel, $fasilitasModel;
    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->jenisWisataModel = new JenisWisataModel();
        $this->galeriWModel = new GaleriModel();
        $this->kodePosModel = new kodePosModel();
        $this->jamWisata = new JamOperasionalModel();
        $this->fasilitasWisataModel = new FasilitasWisataModel();
        $this->fasilitasModel = new FasilitasModel();
    }


    public function index()
    {

        // $file =  ('/public/TSP/coords.js');

        // // Mendapatkan file json
        // $anggota = file_get_contents($file);

        // // Mendecode anggota.json
        // $datax = json_decode($anggota, true);

        // dd($datax);


        $wisata = $this->wisataModel->getWisata();

        $data = [
            'dataW' => $wisata,
            'title' => 'Data Wisata',
            'loc' => 'wisata',
            'subTitle' => ''
        ];
        if (session()->get('role') == 1) {


            return view('Wisata/index', $data);
        } else {
            return redirect()->to(base_url() . '/');
        }
    }

    public function detail($id)
    {

        $galeri = $this->galeriWModel->getGaleri(NULL, 'wisata', $id);
        $wisata = $this->wisataModel->getWisata($id);
        $fasilitasWisata = $this->fasilitasWisataModel->getFasilitasWisata("", $id);
        // dd($fasilitasWisata);
        $data = [
            'fasilitasW' => $fasilitasWisata,
            'galeriW' => $galeri,
            'detailW' => $wisata,
            'title' => 'Data Wisata',
            'loc' => 'wisata',
            'subTitle' => 'Detail'
        ];
        return view('Wisata/detail', $data);
    }

    public function edit($id)
    {
        $fasilitas =  $this->fasilitasModel->getFasilitas();
        $kodePos = $this->kodePosModel->getKodePos();
        $galeri = $this->galeriWModel->getGaleri(NULL, 'wisata', $id);
        $wisata = $this->wisataModel->getWisata($id);
        $jWisata = $this->jenisWisataModel->getJenisWisata();
        $jamWisata = $this->jamWisata->getJam();
        $fasilitasWisata = $this->fasilitasWisataModel->getFasilitasWisata('', $id);
        $data = [
            'fasilitas' => $fasilitas,
            'fasilitasWisata' => $fasilitasWisata,
            'jamWisata' => $jamWisata,
            'jenisWisata' => $jWisata,
            'kodePos' => $kodePos,
            'galeriW' => $galeri,
            'detailW' => $wisata,
            'title' => 'Data Wisata',
            'loc' => 'wisata',
            'subTitle' => 'Edit',
            'validation' => \Config\Services::validation()
        ];
        return view('Wisata/edit', $data);
    }


    public function tambah()
    {
        // session();
        $jWisata = $this->jenisWisataModel->getJenisWisata();
        $kodePos = $this->kodePosModel->getKodePos();
        $jamWisata = $this->jamWisata->getJam();
        $data = [
            'jamWisata' => $jamWisata,
            'jenisWisata' => $jWisata,
            'kodePos' => $kodePos,
            'title' => 'Data Wisata',
            'loc' => 'wisata',
            'subTitle' => 'Tambah',
            'validation' => \Config\Services::validation()
        ];
        return view('Wisata/tambah', $data);
    }



    public function save()
    {
        if (!$this->validate([
            'namaWisata' => [
                'rules' => 'required|is_unique[wisata.namaWisata]',
                'errors' => [
                    'required' => 'Nama Wisata tidak harus diisi.',
                    'is_unique' => 'Nama Wisata sudah ada'
                ]
            ],

            'alamatWisata' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat destinasi diperlukan'
                ]
            ],
            'latitude' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Silahkan isi Latitude',
                    'decimal' => 'Hanya inputkan angka'
                ]
            ],
            'longitude' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Silahkan isi Longitude',
                    'decimals' => 'Hanya inputkan angka'
                ]
            ],
            'jenisWisata' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Wisata tidak boleh kosong'
                ]
            ],
            'kodePos' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Pos tidak boleh kosong'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/wisata/tambah')->withInput()->with('validation', $validation);
        }

        $this->wisataModel->save(
            [
                'namaWisata' => $this->request->getVar('namaWisata'),
                'cpWisata' => $this->request->getVar('cp'),
                'alamatWisata' => $this->request->getVar('alamatWisata'),
                'latWisata' => $this->request->getVar('latitude'),
                'longWisata' => $this->request->getVar('longitude'),
                'idJam' => $this->request->getVar('idJam'),
                'keterangan' => $this->request->getVar('namaWisata'),
                'deskripsiW' => $this->request->getVar('desc'),
                'idjenisWisata' => $this->request->getVar('jenisWisata'),
                'idkodePos' => $this->request->getVar('kodePos'),
            ]
        );
        $idnew = $this->wisataModel->getWisatabyName($this->request->getVar('namaWisata'));
        $fileFoto =  $this->request->getFile('fotoWisata');
        $name = $idnew[0]['namaWisata'];
        $rand = $fileFoto->getRandomName();
        $namaFile = url_title($name, '_', true) . '.' . $rand;

        $fileFoto->move('assets/img/wisata', $namaFile);

        $this->galeriWModel->save([
            'namafile' => $namaFile,
            'namaTable' => 'wisata',
            'id' => $idnew[0]['idWisata']
        ]);

        session()->setFlashdata('pesan', 'Data Wisata Berhasil Ditambahkan');
        return redirect()->to('/wisata');
    }



    public function delete($id)
    {
        $galer = $this->galeriWModel->getGaleri(null, 'wisata', $id);
        $i = 0;
        foreach ($galer as $G) {
            unlink('assets/img/wisata/' . $galer[$i]['namafile']);
            $i++;
        }
        $this->galeriWModel->where('namaTable', 'Wisata')->where('id', $id)->delete();
        session()->setFlashdata('pesanDel', 'Data Wisata Berhasil Dihapus');
        $this->wisataModel->delete($id);
        return redirect()->to('/wisata');
    }





    public function update($id)
    {
        // cek nama
        $namaLama = $this->wisataModel->getWisata($id);
        if ($namaLama[0]['namaWisata'] == $this->request->getVar('namaWisata')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[wisata.namaWisata]';
        };

        if (!$this->validate([
            'namaWisata' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => 'Nama Wisata tidak harus diisi.',
                    'is_unique' => 'Nama Wisata sudah ada'
                ]
            ],

            'alamatWisata' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat destinasi diperlukan'
                ]
            ],
            'latitude' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Silahkan isi Latitude',
                    'decimal' => 'Hanya inputkan angka'
                ]
            ],
            'longitude' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Silahkan isi Longitude',
                    'decimals' => 'Hanya inputkan angka'
                ]
            ],
            'jenisWisata' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Wisata tidak boleh kosong'
                ]
            ],
            'kodePos' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode Pos tidak boleh kosong'
                ]
            ]

        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisata'))->withInput();
        }
        // return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisata'))->withInput()->with('validation', $validation);


        // dd($this->request->getVar());
        // // dd($id);
        // $test = $this->wisataModel->getWisata($id);
        // dd($test, $this->request->getVar());

        $this->wisataModel->save(
            [
                'idWisata' => $id,
                'namaWisata' => $this->request->getVar('namaWisata'),
                'cpWisata' => $this->request->getVar('cp'),
                'alamatWisata' => $this->request->getVar('alamatWisata'),
                'latWisata' => $this->request->getVar('latitude'),
                'longWisata' => $this->request->getVar('longitude'),
                'idJam' => $this->request->getVar('idJam'),
                'keterangan' => $this->request->getVar('namaWisata'),
                'deskripsiW' => $this->request->getVar('desc'),
                'idjenisWisata' => $this->request->getVar('jenisWisata'),
                'idkodePos' => $this->request->getVar('kodePos')
            ]
        );

        session()->setFlashdata('pesanWarn', 'Data Wisata Berhasil Diubah');
        return redirect()->to('/wisata');
    }


    public function updateImgW()
    {
        $fileFoto =  $this->request->getFile('editImg');
        // dd($this->request->getVar());
        $idWisata = $this->request->getVar('Edit_idWisataX');
        $wisata = $this->wisataModel->getWisata($idWisata);
        // dd($wisata);
        // dd($this->request->getFile('editImg'));
        $name = $wisata[0]['namaWisata'];
        $rand = $fileFoto->getRandomName();
        $namaLama = $this->request->getVar('Edit_namaFile');
        $namaFile = url_title('wisata' . '_' . $name, '_', true) . '_' . $rand;
        // dd($namaFile);
        $fileFoto->move('assets/img/wisata', $namaFile);
        unlink('assets/img/wisata/' . $namaLama);
        $this->galeriWModel->save([
            'idgaleri' => $this->request->getVar('Edit_idGaleri'),
            'namafile' => $namaFile,
            'namaTable' => 'wisata'
        ]);

        session()->setFlashdata('pesanWarn', 'Foto Berhasil Diubah');
        return redirect()->to('/wisata/edit/' . $this->request->getVar('Edit_idWisataX'));
    }



    public function addImgW()
    {

        $idnew = $this->wisataModel->getWisata($this->request->getVar('idWisata'));
        // $galeri = $this->galeriWModel->getGaleri(NULL, 'wisata', $this->request->getVar('idWisata'));
        // $hasil = count($galeri);

        $fileFoto =  $this->request->getFile('fotoWisata');
        $name = $idnew[0]['namaWisata'];
        $rand = $fileFoto->getRandomName();
        $namaFile = url_title('wisata' . '_' . $name, '_', true) . '_' . $rand;

        $fileFoto->move('assets/img/wisata', $namaFile);

        $this->galeriWModel->save([
            'namafile' => $namaFile,
            'namaTable' => 'wisata',
            'id' => $idnew[0]['idWisata']
        ]);
        session()->setFlashdata('pesan', 'Foto Berhasil Ditambahkan');
        return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisata'));
    }

    public function removeImg()
    {

        // dd($this->request->getVar());
        // dd($this->request->getVar('idGaleri'));
        // dd($this->galeriWModel->getGaleri('37'))
        $galer = $this->galeriWModel->getGaleri($this->request->getVar('idGaleri'));
        unlink('assets/img/wisata/' . $galer[0]['namafile']);


        $this->galeriWModel->delete($this->request->getVar('idGaleri'));
        session()->setFlashdata('pesanDel', 'Foto Berhasil Dihapus');
        return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisataX'));
    }

    public function updateFasilitas()
    {
        // dd($this->request->getVar());
        $this->fasilitasWisataModel->save([
            'id_fasilitas_wisata' => $this->request->getVar('idFW'),
            'idFasilitas' => $this->request->getVar('Ufasilitas'),
            'keteranganF' => $this->request->getVar('UketeranganF'),
            'idWisata' => $this->request->getVar('idWisata'),
        ]);
        session()->setFlashdata('pesan', 'Fasilitas Berhasil DiUpdate');
        return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisata'));
    }

    public function addFasilitas()
    {
        // dd($this->request->getVar());
        $this->fasilitasWisataModel->save([
            'idFasilitas' => $this->request->getVar('fasilitas'),
            'keteranganF' => $this->request->getVar('keteranganF'),
            'idWisata' => $this->request->getVar('idWisata'),
        ]);
        session()->setFlashdata('pesan', 'Fasilitas Berhasil Ditambahkan');
        return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisata'));
    }

    public function deleteFasilitas()
    {
        $this->fasilitasWisataModel->delete($this->request->getVar('DidFW'));
        session()->setFlashdata('pesanDel', 'Fasilitas Wisata Berhasil Dihapus');
        return redirect()->to('/wisata/edit/' . $this->request->getVar('idWisata'));
    }
}
