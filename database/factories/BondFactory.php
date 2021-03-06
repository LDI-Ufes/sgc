<?php

namespace Database\Factories;

use App\Models\Bond;
use App\Models\Course;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Pole;
use Illuminate\Database\Eloquent\Factories\Factory;

class BondFactory extends Factory
{
    /**
     * Bond Factory
     *
     * @var string
     */
    protected $model = Bond::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $issueStatus = random_int(1, 3); // 1 - Not reviewed; 2 - Reviewed-Approved; 3 - Reviewed-Not approved

        return [
            'course_id' => Course::factory(),
            'employee_id' => Employee::factory(),
            'role_id' => Role::factory(),
            'pole_id' => Pole::factory(),

            'begin' => $this->faker->dateTimeBetween('-2 years', '-1 year'),
            'end' => $this->faker->dateTimeBetween('now', '+1 year'),
            // 'terminated_at' => $this->faker->dateTimeBetween('+1 year', '+2 years'),
            // 'volunteer' => $this->faker->boolean($changeOfGettingTrue = 50),
            'volunteer' => false,
            'impediment' => ($issueStatus == 3) ? true : false,
            'impediment_description' =>  ($issueStatus == 3) ? 'Problema na documentação' : '',
            'uaba_checked_at' => ($issueStatus != 1) ? $this->faker->dateTimeBetween('-2 years', '-1 year') : null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
