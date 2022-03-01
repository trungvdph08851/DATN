<?php

namespace Database\Seeders;

use App\Models\Doctor_services;
use Illuminate\Database\Seeder;

class Doctor_servicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Doctor_services::factory(10)->create();
    }
}
