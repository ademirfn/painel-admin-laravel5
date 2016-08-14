<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //\DB::table('role')->truncate();
        factory('App\Models\Role')->create(
                [
                    'name' => 'root'
                ]
        );
        factory('App\Models\Role')->create(
                [
                    'name' => 'admin'
                ]
        );
        factory('App\Models\Role')->create(
                [
                    'name' => 'client'
                ]
        );
    }

}
