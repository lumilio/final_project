<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services_arrey = [
            ['name' => 'TV'],
            ['name' => 'Wifi'],
            ['name' => 'Posto Macchina'],
            ['name' => 'Ascensore'],
            ['name' => 'Cucina'],
            ['name' => 'Aria condizionata'],
            ['name' => 'Giardino'],
            ['name' => 'Vista mare'],
            ['name' => 'Sauna'],
            ['name' => 'Portineria'],
            ['name' => 'Piscina'],
        ];

        foreach ($services_arrey as $i){
            $_item = new Service();
            $_item->name = $i['name'];
            $_item-> save();
        }
    }
}



