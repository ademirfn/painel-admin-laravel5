<?php

use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\DB::table('banner')->truncate();    
        factory('App\Models\Banner')->create([
        		'title' => 'Promoção um',       
		        'subtitle' => 'Subtitle promoção um',       
		        'description' => 'Um pequeno texto referente a promoção um',   
		        'image' => '01.jpg',
		        'link' => 'http://dominio.com.br/1/promocao-um'
        	]);
        factory('App\Models\Banner')->create([
        		'title' => 'Promoção dois',       
		        'subtitle' => 'Subtitle promoção dois',       
		        'description' => 'Um pequeno texto referente a promoção dois',   
		        'image' => '01.jpg',
		        'link' => 'http://dominio.com.br/2/promocao-dois'
        	]);
        factory('App\Models\Banner')->create([
        		'title' => 'Promoção tres',       
		        'subtitle' => 'Subtitle promoção tres',       
		        'description' => 'Um pequeno texto referente a promoção tres',   
		        'image' => '01.jpg',
		        'link' => 'http://dominio.com.br/2/promocao-tres'
        	]);
    }
}
