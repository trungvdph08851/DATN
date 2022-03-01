<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Services::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $imgName = $this->faker->image(storage_path("app/public/uploads/services"), $width = 640, $height = 480, 'cats', false);
        return [
            //
            'name' => $this->faker->name(),
            'title' => $this->faker->text(),
            'image' => "uploads/services/" . $imgName,
            'description' => $this->faker->text(),
            'price' => rand(1000,5000),
            'status' => rand(1,4)
        ];
    }
}
