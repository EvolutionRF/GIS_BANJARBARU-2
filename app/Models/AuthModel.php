<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{

    protected $table      = 'users';
    protected $primaryKey = 'idUsers';
    protected $allowedFields = ['username', 'password', 'namaUser', 'role'];

    public function cekLogin($username = false, $password = false)
    {
        return $this->db->table('users')
            ->where(array('username' => $username, 'password' => $password))
            ->get()->getRowArray();
    }

    public function getUsers($id = false, $role = false)
    {
        if ($id == false) {
            if ($role == 1) {
                return $this->db->table('users')
                    ->where('role', $role)
                    ->get()->getResultArray();
            } else {
                return $this->db->table('users')
                    ->where('role', $role)
                    ->get()->getResultArray();
            }
        } else {
            return $this->db->table('users')
                ->where('idUsers', $id)
                ->get()->getResultArray();
        }
    }
}
