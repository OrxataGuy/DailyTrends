<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Publisher::create([
            'site' => 'https://as.com',
            'name' => 'AS',
            'icon' => 'https://as.com/pf/resources/images/favicon/favicon.svg?d=213'
        ]);

        Publisher::create([
            'site' => env('app_url'),
            'name' => 'DailyTrends',
            'icon' => ''
        ]);

        Publisher::create([
            'site' => 'https://www.elmundo.com',
            'name' => 'ElMundo',
            'icon' => 'https://www.elmundo.com/recursos/images/iconos-top/iconos-top_08.png'
        ]);

        Publisher::create([
            'site' => 'https://elpais.com',
            'name' => 'ElPais',
            'icon' => 'https://static.elpais.com/dist/resources/images/favicon.ico',
            'enabled' => 1
        ]);

        Publisher::create([
            'site' => 'https://www.marca.com',
            'name' => 'Marca',
            'icon' => 'https://www.marca.com/favicon_32x32.png'
        ]);

        Publisher::create([
            'site' => 'https://www.levante-emv.com',
            'name' => 'Levante',
            'icon' => 'https://www.levante-emv.com/favicon-levante-emv.png',
            'enabled' => 1
        ]);

        Publisher::create([
            'site' => 'https://valenciaplaza.com',
            'name' => 'ValenciaPlaza',
            'icon' => 'https://valenciaplaza.com/favicon.ico'
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
