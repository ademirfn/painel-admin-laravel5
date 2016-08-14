<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //\DB::table('users')->truncate();

        factory('App\Models\User')->create(
                [                    
                    'name' => 'root',
                    'email' => 'root@wadmin.com.br',
                    'password' => bcrypt(123456),                    
                    'role_id' => 1,
                    'active' => 'Y'
                ]
        );
        factory('App\Models\User')->create(
                [         
                    'name' => 'admin',
                    'email' => 'admin@wadmin.com.br',
                    'password' => bcrypt(123456),                    
                    'role_id' => 2,
                    'active' => 'Y'
                ]
        );        
        
    }

}
