<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Cars extends Seeder
{
    public function run()
    {
        $cars_data = [
            [
                'jenisMobil' => 'INNOVA ZENIX',
                'noPolisi' => 'B 394 G',
                'jadwalService' => '30-10-2023',
                'available' => true
            ]
        ];
        foreach($cars_data as $data){
			$this->db->table('Cars')->insert($data);
		}
    }
}
