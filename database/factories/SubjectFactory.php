<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;


class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->unique()->randomElement([
                '3D grafika a multimédia',
                'Anglický jazyk',
                'Cvičení z programování',
                'Cvičení z administrativy',
                'Český jazyk a literatura',
                'Člověk v dějinách',
                'Konfigurace a správa ICT zařízení',
                'Konverzace v Anglickém jazyce',
                'Matematika', 'Tělesná výchova',
                'Vývoj desktopových a mobilních aplikací',
                'Fyzika',
                'Německý jazyk',
                'Manažerská studia',
                'Ekonomika a účetnictví',
                'Práce s počítačem',
                'Bussiness komunikace a etiketa',
                'Biologie',
                'Hotelnictví a hospitality management',
                'Cestovní ruch a průvodcovství',
                'Geografie cestovního ruchu',
                'Beverage',
                'Informatika',
                'Biologie a ekologie',
                'Aplikovaná psychologie',
                'Účetnictví',
                'Písemná a elektronická komunikace',
                'Management',
                'Učební praxe',
                'Marketing'
            ]),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
