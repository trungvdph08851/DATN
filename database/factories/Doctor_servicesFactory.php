<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Doctor_services;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

class Doctor_servicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor_services::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'services_id' =>Services::all()->random()->id,
            'doctor_id' =>Doctor::all()->random()->id
        ];
    }
}
