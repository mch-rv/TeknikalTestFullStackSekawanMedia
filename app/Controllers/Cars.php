<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CarsModel;
use App\Models\ReportModel;
use Config\Service;


class Cars extends BaseController
{
    protected $cars;
    protected $report;

    function __construct()
    {
        $this->cars = new CarsModel();
        $this->report = new ReportModel();
    }
    public function index()
    {
        $keyword=$this->request->getVar('keyword');
        if($keyword){
            $Data = $this->cars->search($keyword);
        }else{
            $Data = $this->cars;
        }
        $currentPage = $this->request->getVar("page_Cars") ? $this->request->getVar("page_Cars") : 1;
        $data = [
            'cars' => $Data->paginate(10,'cars'),
            'pager' => $this->cars->pager,
            'currentPage' => $currentPage
        ];
        return view('CarList/index', $data);
    }
    public function create()
    {
        if(session()->get('Role')=='Admin'){
            return view('CarList/create');
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function store()
    {
        if (!$this->validate([
            'jenisMobil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi',
                ]
            ],
            'noPolisi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'jadwalService' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->cars->insert([
            'id' => $this->request->getVar('id'),
            'jenisMobil' => $this->request->getVar('jenisMobil'),
            'noPolisi' => $this->request->getVar('noPolisi'),
            'jadwalService' => date("d-m-Y", strtotime($this->request->getVar('jadwalService'))),
            'available' => 1,
        ]);
        session()->setFlashdata('message', 'Tambah Data Berhasil');
        return redirect()->to('/cars');
    }
    function edit($id)
    {
        if(session()->get('Role')=='Admin'){
            $dataCars = $this->cars->find($id);
            if (empty($dataCars)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['cars'] = $dataCars;
            return view('carList/edit', $data);
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function update($id)
    {
        if (!$this->validate([
            'jadwalService' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        
        if($this->cars->update($id, [
            'jadwalService' => date("d-m-Y", strtotime($this->request->getVar('jadwalService'))),
            ]));
            session()->setFlashdata('message', 'Update Data Berhasil');
            return redirect()->to('/cars');
        }
    function delete($id)
    { 
        if(session()->get('Role')=='Admin'){
            $dataCars = $this->cars->find($id);
            $this->cars->where('id', $id);
            $this->cars->delete($id);
            session()->setFlashdata('error', 'Delete Data Berhasil');
            return redirect()->to(base_url('cars'));
        }else{
            return redirect()->to(base_url('cars'));
        }
    }
}   