<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'creator_id' => 1,
            'name' => 'انجمن شاعران مرده',
            'description' => 'توضیحات انجمن شاعران مرده',
        ];
    }
}
