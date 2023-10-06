<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class CarsModel extends Model
{
    protected $table = "cars";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','jenisMobil', 'noPolisi','jadwalService','riwayatPemakaian','available'];

    protected $column_order = array(NULL,'jenisMobil','noPolisi',NULL,NULL,'available');
    protected $column_search = array('jenisMobil','noPolisi','available');
    protected $order = array('Tanggal'=>'asc');

    public function search($keyword)
    {
        return $this->table('cars')->like('jenisMobil',$keyword)
        ->orLike('noPolisi',$keyword)->orLike('available',$keyword);
    }
}