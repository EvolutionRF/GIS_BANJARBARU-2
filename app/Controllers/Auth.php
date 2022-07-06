<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{

    protected $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        if (session()->get('role') == null) {

            return view('Auth/login', $data);
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $login = $this->authModel->cekLogin($username, $password);
        // dd($login);

        if ($login == null) {
            session()->setFlashdata('pesanLogin', 'Username atau Password salah');
            return redirect()->to(base_url() . '/login');
        } elseif (($login['username'] == $username) && ($login['password'] == $password)) {
            session()->set('idUsers', $login['idUsers']);
            session()->set('username', $login['username']);
            session()->set('namaUser', $login['namaUser']);
            session()->set('password', $login['password']);
            session()->set('role', $login['role']);
            return  redirect()->to(base_url('/'));
        } else {
            session()->setFlashdata('pesanLogin', 'Username atau Password salah');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url() . '/login');
    }

    public function register()
    {
        $data = [
            'title' => 'Registrasi'
        ];
        if (session()->get('role') == null) {

            return view('Auth/register', $data);
        } else {
            return redirect()->to(base_url('/'));
        }
    }


    function daftar()
    {
        // dd($this->request->getVar());
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $fullname = $this->request->getVar('fullname');
        $role = $this->request->getVar('role');

        $this->authModel->save(
            [
                'username' => $username,
                'password' => $password,
                'namaUser' => $fullname,
                'role' => $role,
            ]
        );

        session()->setFlashdata('pesan', 'Berhasil Mendaftar');
        return redirect()->to('/login');
    }
}
