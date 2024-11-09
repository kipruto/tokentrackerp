<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'project_name' => $this->faker->words(3, true),
            'start_date' => $this->faker->dateTimeBetween('-1 years', 'now'), // Corrected field name
            'client_name' => $this->faker->company,
            'deadline' => $this->faker->dateTimeBetween('now', '+6 months'),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Completed', 'Cancelled']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            $employees = Employee::inRandomOrder()->take(rand(2, 5))->pluck('id'); // Select random employees
            $project->employees()->attach($employees); // Attach employees to project
        });
    }
}
