<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $users_data = [
            [
                'Username' => 'Admin',
                'Password' => password_hash("Admin",PASSWORD_DEFAULT),
                'Name' => 'Admin',
                'Role' => 'Admin',
            ],
            [
                'Username' => 'HeadDiv',
                'Password' => password_hash("HeadDiv",PASSWORD_DEFAULT),
                'Name' => 'HeadDiv',
                'Role' => 'HeadDiv',
            ],
            [
                'Username' => 'Manager',
                'Password' => password_hash("Manager",PASSWORD_DEFAULT),
                'Name' => 'Manager',
                'Role' => 'Manager',
            ],
        ];
        foreach($users_data as $data){
			$this->db->table('Users')->insert($data);
		}
    }
}
