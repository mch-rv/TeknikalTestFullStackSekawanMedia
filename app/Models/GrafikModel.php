<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class GrafikModel extends Model
{
    protected $table = "grafik";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['id','year', 'jumlah',];
}