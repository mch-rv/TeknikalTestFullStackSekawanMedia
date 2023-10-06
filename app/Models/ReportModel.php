<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class ReportModel extends Model
{
    protected $table = "report";
    protected $primaryKey = "uid";
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
        'jadwalService',
        'riwayatPemakaian',
        'available'];
}