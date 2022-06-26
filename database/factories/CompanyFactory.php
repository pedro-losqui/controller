<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cnpj' => '20059106000178',
            'company' => 'INTEGRA SERVICOS EM TECNOLOGIA DA INFORMACAO LTDA',
            'start' => '2000-01-01',
            'end' => '2000-01-01',
            'status' => '1'
        ];
    }
}
