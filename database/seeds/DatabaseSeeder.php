<?php

use Illuminate\Database\Seeder;
use NetworkConfigurator\Router;
use NetworkConfigurator\Switches;
use NetworkConfigurator\Configuration;
use NetworkConfigurator\SwitchConfiguration;
use NetworkConfigurator\User;
use NetworkConfigurator\DataLayer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Guido',
            'password' => bcrypt('garolla'),
            'email' => 'g.garolla@studenti.unibs.it',
            'email_verified_at' => now()
        ]);
        
        User::create([
            'name' => 'Mario',
            'password' => bcrypt('rossi'),
            'email' => 'm.rossi@studenti.unibs.it',
            'email_verified_at' => now()
        ]);
        
        $dl = new DataLayer();
        $user1 = $dl->getUserID('g.garolla@studenti.unibs.it');
        $user2 = $dl->getUserID('m.rossi@studenti.unibs.it');
        
//        Router::where('userID', $user1)->each(function($router) {
//           factory(Configuration::class,1)->create(['deviceID' => $router->serialNumber]); 
//        });
//        
//        Router::where('userID', $user2)->each(function($router) {
//           factory(Configuration::class,1)->create(['deviceID' => $router->serialNumber]); 
//        });
//        
//        Switches::where('userID', $user1)->each(function($switches) {
//           factory(SwitchConfiguration::class,1)->create(['deviceID' => $switches->serialNumber]); 
//        });
//        
//        Switches::where('userID', $user2)->each(function($switches) {
//           factory(SwitchConfiguration::class,1)->create(['deviceID' => $switches->serialNumber]); 
//        });
        
        factory(Router::class,10)->create(['userID' => $user1]);
        $routers_list1 = json_decode($dl->listRouters($user1));
        
        for($i=0; $i<5; $i++) {
            $router = $routers_list1[array_rand($routers_list1)];
            factory(Configuration::class,1)->create(['deviceID' => $router->serialNumber]);
        }
        
        factory(Switches::class,10)->create(['userID' => $user1]);
        $switches_list1 = json_decode($dl->listSwitches($user1));
        
        for($i=0; $i<5; $i++) {
            $switch = $switches_list1[array_rand($switches_list1)];
            factory(SwitchConfiguration::class,1)->create(['deviceID' => $switch->serialNumber]);
        }
        
        factory(Router::class,10)->create(['userID' => $user2]);
        $routers_list2 = json_decode($dl->listRouters($user2));
        
        for($i=0; $i<5; $i++) {
            $router = $routers_list2[array_rand($routers_list2)];
            factory(Configuration::class,1)->create(['deviceID' => $router->serialNumber]);
        }
        
        factory(Switches::class,10)->create(['userID' => $user2]);
        $switches_list2 = json_decode($dl->listSwitches($user2));
        
        for($i=0; $i<5; $i++) {
            $switch = $switches_list2[array_rand($switches_list2)];
            factory(SwitchConfiguration::class,1)->create(['deviceID' => $switch->serialNumber]);
        }
    }
}
