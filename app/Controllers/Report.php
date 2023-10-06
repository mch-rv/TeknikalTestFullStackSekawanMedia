<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReportModel;
use App\Models\CarsModel;
use App\Models\GrafikModel;
use Config\Service;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
{
    protected $report;
    protected $cars;
    protected $grafik;

    function __construct()
    {
        $this->report = new ReportModel();
        $this->cars = new CarsModel();
        $this->grafik = new GrafikModel();
    }
    public function index()
    {
        $keyword=$this->request->getVar('keyword');
        if($keyword){
            $Data = $this->report->search($keyword);
        }else{
            $Data = $this->report;
        }
        $currentPage = $this->request->getVar("page_Report") ? $this->request->getVar("page_Report") : 1;
        $data = [
            'report' => $Data->paginate(10,'report'),
            'pager' => $this->report->pager,
            'currentPage' => $currentPage
        ];
        return view('report/index', $data);
    }
    public function create($id)
    {
        if(session()->get('Role')=='Admin'){
            $dataCars = $this->cars->find($id);
            if (empty($dataCars)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['cars'] = $dataCars;
            return view('report/create', $data);
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function store($id)
    {
        if (!$this->validate([
            'Driver' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'tanggalPengajuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        if($this->report->insert([
            'id' => $this->request->getVar('id'),
            'uid' => $id,
            'jenisMobil' => $this->request->getVar('jenisMobil'),
            'noPolisi' => $this->request->getVar('noPolisi'),
            'Driver' => $this->request->getVar('Driver'),
            'tanggalPengajuan' => date("d-m-Y", strtotime($this->request->getVar('tanggalPengajuan'))),
        ])){
            $this->cars->update($id, [
                'available' => false,
            ]);
            session()->setFlashdata('message', 'Tambah Data Berhasil');
            return redirect()->to('/report');
        }
    }
    function edit($id)
    {
        if(session()->get('Role')=='Admin'){
            $dataReport = $this->report->find($id);
            if (empty($dataReport)) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak ditemukan !');
            }
            $data['report'] = $dataReport;
            return view('report/edit', $data);
        }else{
            return redirect()->to(base_url('home'));
        }
    }
    public function update($id,$uid)
    {
        $year=date('Y');
        $jumlah=$this->grafik->jumlah;
        if (!$this->validate([
            'tanggalPengembalian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'BBM' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back();
        }
        
        if($this->report->update($id, [
            'tanggalPengembalian' => date("d-m-Y", strtotime($this->request->getVar('tanggalPengembalian'))),
            'BBM' => $this->request->getVar('BBM')
            ])){
                $this->cars->update($uid, [
                    'available' => true,
                    'riwayatPemakaian' => date("d-m-Y", strtotime($this->request->getVar('tanggalPengembalian')))
                ]);
                $this->grafik->update(1, [
                    'jumlah' => $jumlah+1,
                ]);
                session()->setFlashdata('message', 'Update Data Berhasil');
                return redirect()->to('/cars');
            }
            
    }
    public function accept($id)
    {
        if(session()->get('Role')=='Manager'){
        $this->report->update($id, [
            'managerApprov' => 1,
            ]);
        }
        if(session()->get('Role')=='HeadDiv'){
            $this->report->update($id, [
                'headDivApprov' => 1,
                ]);
            }
            session()->setFlashdata('message', 'Update Data Berhasil');
            return redirect()->to('/report');
    }
    public function reject($id,$uid)
    {
        if(session()->get('Role')=='HeadDiv'){
            $this->report->update($id, [
                'headDivApprov' => 0,
                'managerApprov' => 0,
            ]);     
        }
        if(session()->get('Role')=='Manager'){
            $this->report->update($id, [
                'managerApprov' => 0,
            ]);
        }
        $this->cars->update($uid, [
            'available' => true,
            ]);
        session()->setFlashdata('message', 'Update Data Berhasil');
        return redirect()->to('/report');
    }
    function delete($id,$uid)
    { 
        if(session()->get('Role')=='Admin'){
            $dataReport = $this->report->find($id);
            $this->report->where('id', $id);
            $this->report->delete($id);
            $this->cars->update($uid, [
                'available' => true,
            ]);
            
            session()->setFlashdata('error', 'Delete Data Berhasil');
            return redirect()->to(base_url('report'));
        }else{
            return redirect()->to(base_url('report'));
        }
    }
    public function exportExcel(){
        $dataReport = $this->report->findAll();
    
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Jenis Mobil')
                    ->setCellValue('C1', 'No Polisi')
                    ->setCellValue('D1', 'Driver')
                    ->setCellValue('E1', 'Tanggal Pengajuan')
                    ->setCellValue('F1', 'Tanggal Pengembalian')
                    ->setCellValue('G1', 'Kepala Divisi')
                    ->setCellValue('H1', 'Manajer')
                    ->setCellValue('I1', 'Pemakaian BBM');
        
        $column = 2;
        $no=0;
        foreach($dataReport as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data->jenisMobil)
                        ->setCellValue('C' . $column, $data->noPolisi)
                        ->setCellValue('D' . $column, $data->Driver)
                        ->setCellValue('E' . $column, $data->tanggalPengajuan)
                        ->setCellValue('F' . $column, $data->tanggalPengembalian)
                        ->setCellValue('G' . $column, $data->headDivApprov)
                        ->setCellValue('H' . $column, $data->managerApprov)
                        ->setCellValue('I' . $column, $data->BBM);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Report'.date('d-m-Y');
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
}