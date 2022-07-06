<?php

namespace App\Controllers;

use App\Models\AuthModel;

class users extends BaseController
{
    protected $AuthModel;
    public function __construct()
    {
        $this->AuthModel = new AuthModel();
    }
    public function index()
    {


        $admin = $this->AuthModel->getUsers('', '1');
        $users = $this->AuthModel->getUsers('', '2');
        // dd($admin, $users);
        $data = [
            'admin' => $admin,
            'users' => $users,
            'title' => 'Data Users',
            'loc' => 'users',
            'subTitle' => ''
        ];

        if (session()->get('role') == 1) {

            return view('users/index', $data);
        } else {
            return redirect()->to(base_url() . '/');
        }
    }

    public function save()
    {

        // dd($this->request->getVar());
        $this->AuthModel->save(
            [
                'username' => $this->request->getVar('username'),
                'password' => $this->request->getVar('password'),
                'namaUser' => $this->request->getVar('nama'),
                'role' => $this->request->getVar('role'),
            ]
        );

        session()->setFlashdata('pesan1', 'Data Admin Berhasil ditambah');

        return redirect()->to('/users');
    }

    public function reset()
    {

        // dd($this->request->getVar());
        $this->AuthModel->save(
            [
                'idUsers' => $this->request->getVar('Rid'),
                'username' => $this->request->getVar('RusernameH'),
                'role' => $this->request->getVar('Rrole'),
                'namaUser' => $this->request->getVar('RnamaH'),
                'password' => '123456'
            ]
        );

        if ($this->request->getVar('Rrole') == '1') {
            session()->setFlashdata('pesanWarn1', 'Password Berhasil direset');
        } elseif ($this->request->getVar('Rrole') == '2') {
            session()->setFlashdata('pesanWarn2', 'Password Berhasil direset');
        }
        return redirect()->to('/users');
    }

    public function delete()
    {

        // dd($this->request->getVar());
        $id = $this->request->getVar('Did');
        $this->AuthModel->delete($id);

        if ($this->request->getVar('Drole') == '1') {

            session()->setFlashdata('pesanDel1', 'Data Admin Berhasil dihapus');
        } elseif ($this->request->getVar('Drole') == '2') {
            session()->setFlashdata('pesanDel2', 'Data User Berhasil dihapus');
        }
        return redirect()->to('/users');
    }

    public function updatePw()
    {

        // dd($this->request->getVar());
        $this->AuthModel->save(
            [
                'idUsers' => $this->request->getVar('idUsers'),
                'username' => $this->request->getVar('usernameZ'),
                'role' => $this->request->getVar('roleX'),
                'namaUser' => $this->request->getVar('fullnameX'),
                'password' => $this->request->getVar('passwordX')
            ]
        );

        session()->set('password', $this->request->getVar('fullnameX'));
        session()->set('namaUser', $this->request->getVar('fullnameX'));
        return redirect()->to('/');
    }
}
