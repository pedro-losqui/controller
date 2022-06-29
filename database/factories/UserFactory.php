<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_id' =>  '1',
            'name' =>  'Administrador Geral',
            'email' => 'admin@admin.com.br',
            'password' => '$2y$10$OXLjsvg1Jw8vF4n2wagqqucbGC8IYVLnp2nu1ZK4aqJSl9xWrehU6', //^@EO1d*kWhxf
            'status' => '1',
            'type' => '0',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
