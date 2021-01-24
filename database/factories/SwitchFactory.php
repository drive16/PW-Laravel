<?php

use NetworkConfigurator\Switches;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Switches::class, function(Faker $faker){
   return [
      'name' => $faker->word,
      'model' => $faker->randomElement(['C2960-X','C2960-S']),
      'type' => $faker->randomElement(['Switches']),
      'firmware' => $faker->randomElement(['12.05','15.06','16.07']),
      'ports' => $faker->randomElement(['24','48']),
      'serialNumber' => $faker->regexify('[A-Z0-9]{11}')
   ]; 
});
