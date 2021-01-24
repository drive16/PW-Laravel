<?php

use NetworkConfigurator\Configuration;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Configuration::class, function(Faker $faker){
   return [
      'hostname' => $faker->word,
      'username' => $faker->userName,
      'password' => $faker->md5,
      'domainName' => $faker->domainName,
      'interface' => $faker->randomElement($array = array ('GigabitEthernet0/0/0','GigabitEthernet0/0/1','GigabitEthernet0/0/2','GigabitEthernet0/0','GigabitEthernet0/1','GigabitEthernet0/2')),
      'ipAddress' => $faker->localIpv4,
      'subnetMask' => $faker->randomElement($array = array ('255.255.255.0')),
      'gateway' => $faker->localIpv4,
   ]; 
});

