<?php

namespace Database\Seeders;

use App\Models\booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        booking::factory(10)->create();
    }
}
