<?php

use NetworkConfigurator\SwitchConfiguration;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(SwitchConfiguration::class, function(Faker $faker){
   return [
      'hostname' => $faker->word,
      'username' => $faker->userName,
      'password' => $faker->md5,
      'domainName' => $faker->domainName,
      'interface' => $faker->randomElement($array = array ('Vlan 1')),
      'ipAddress' => $faker->localIpv4,
      'subnetMask' => $faker->randomElement($array = array ('255.255.255.0')),
      'gateway' => $faker->localIpv4,
   ]; 
});