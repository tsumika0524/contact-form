<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->value('id'),

            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,

            // 1:男性 2:女性 3:その他
            'gender'     => $this->faker->randomElement([1, 2, 3]),

            'email'      => $this->faker->unique()->safeEmail,
            'tel'        => $this->faker->numerify('090########'),

            'address'    => $this->faker->address,
            'building'   => $this->faker->optional()->secondaryAddress,

            'detail'     => $this->faker->realText(80),
        ];
    }
}
