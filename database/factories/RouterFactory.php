<?php

use NetworkConfigurator\Router;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Router::class, function(Faker $faker){
   return [
      'name' => $faker->word,
      'model' => $faker->randomElement(['Cisco 2911','Cisco 4331']),
      'type' => $faker->randomElement(['Router']),
      'firmware' => $faker->randomElement(['16.09.03','16.09.05','12.05']),
      'ports' => $faker->randomElement(['3']),
      'serialNumber' => $faker->regexify('[A-Z0-9]{11}')
   ]; 
});