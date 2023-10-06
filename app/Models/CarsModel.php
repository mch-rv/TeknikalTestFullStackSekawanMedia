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
}