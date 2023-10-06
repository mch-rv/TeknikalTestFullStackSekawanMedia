<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GrafikmoDEL;

class Home extends BaseController
{
    protected $Users;
    protected $report;
    function __construct()
    {
        $this->Users = new UsersModel();
        $this->grafik = new GrafikmoDEL();
    }
    public function index()
    {
        $dataUsers = $this->Users->findAll();
        $dataGrafik = $this->grafik->findAll();
        if (empty($dataUsers)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
        }
        $data['users'] = $dataUsers;
        $data['grafik'] = $dataGrafik;
        return view('home', $data);
    }
}