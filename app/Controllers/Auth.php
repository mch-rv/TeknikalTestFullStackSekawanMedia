<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $users;
    function __construct()
    {
        $this->users = new UsersModel();
    }
    public function login()
    {
        if(session()->get('logged_in')==TRUE){
            return redirect()->to(base_url('home'));
        }else{
        return view('vw_login');
        }
    }
    public function loginprocess()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $this->users->where([
            'Username' => $username,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->Password)) {
                session()->set([
                    'Username' => $dataUser->Username,
                    'Name' => $dataUser->Name,
                    'Role' => $dataUser->Role,
                    'Id' => $dataUser->id,
                    'logged_in' => TRUE,
                ]);
                return redirect()->to(base_url('home'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('Auth/login');
    }
}

