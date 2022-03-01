<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imgName = $this->faker->image(storage_path("app/public/uploads/doctor"), $width = 640, $height = 480, 'cats', false);
        return [
            //
            'name' => $this->faker->name(),
            'avatar' => "uploads/doctor/" . $imgName,
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->text(),
            'status' => rand(1,4),
            'doctor_code' => "ph" . rand(1000,2000)
        ];
    }
}
