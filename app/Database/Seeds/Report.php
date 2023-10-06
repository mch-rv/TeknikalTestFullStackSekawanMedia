<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Report extends Seeder
{
    public function run()
    {
        $report_data = [
            [
                'jenisMobil' => 'INNOVA ZENIX',
                'noPolisi' => 'B 394 G',
                'Driver' => 'Ujang',
                'tanggalPengajuan' => '16-08-2023',
            ]
        ];
        foreach($report_data as $data){
			$this->db->table('report')->insert($data);
		}
    }
}
