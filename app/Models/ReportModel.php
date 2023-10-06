<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ReportModel extends Model
{
    protected $table = "report";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id',
        'uid',
        'jenisMobil', 
        'noPolisi',
        'Driver',
        'tanggalPengajuan',
        'tanggalPengembalian',
        'headDivApprov',
        'managerApprov',
        'BBM',
        'riwayatPemakaian'];

        protected $column_order = array(NULL,
        'jenisMobil',
        'noPolisi',
        'Driver',
        'tanggalPengajuan',
        'tanggalPengembalian',
        NULL,
        NULL,
        'BBM',);
        protected $column_search = array('jenisMobil','noPolisi','tanggalPengajuan','tanggalPengembalian','BBM','riwayatPemakaian');
        protected $order = array('tanggalPengajuan'=>'asc');
    
        public function search($keyword)
        {
            return $this->table('report')->like('jenisMobil',$keyword)
            ->orLike('noPolisi',$keyword)->orLike('tanggalPengajuan',$keyword)
            ->orLike('tanggalPengembalian',$keyword);
        }
}