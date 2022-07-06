<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class adminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if(session()->get('role')==""){
            session()->getFlashdata('pesanLogin','Anda belum login, Silahkan Login terlebih dahulu');
            return redirect()->to(base_url('auth/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('role')==1) {
            return redirect()->to(base_url('/dashboard'));
        }
    }
}
