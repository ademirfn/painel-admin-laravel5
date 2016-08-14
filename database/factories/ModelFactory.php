<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name        
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $email = $faker->email;
    return [  
        'name' => $faker->name,
        'email' => $email,
        'password' => bcrypt(str_random(10)),
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->date,
        'gender' => $faker->randomElement($array = array ('M','F')),        
        'cpf' => $faker->randomNumber,       
        'role_id' => 3,
        'active' => 'Y',        
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Modules\Blog\Models\Image::class, function (Faker\Generator $faker) {
    return [
        'extension' => $faker->randomElement($array = array ('jpg','png','gif')),              
        'product_id' => $faker->numberBetween(1, 50)        
    ];
});

$factory->define(App\Modules\Banners\Models\Banner::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,       
        'subtitle' => $faker->word,       
        'description' => $faker->paragraph,   
        'image' => $faker->imageUrl($width = 1200, $height = 400),
        'link' => $faker->url     
    ];
});

$factory->define(App\Models\Newsletter::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,   
        'email' => $faker->email   
    ];
});
