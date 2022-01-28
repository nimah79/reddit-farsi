<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'community_id' => 1,
            'title' => 'لورم ایپسوم',
            'body' => 'لورم ایپسوم **متن تستی**.',
        ];
    }
}
