<?php

namespace Database\Factories;

use App\Models\Role;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        $name = $this->faker->word;
        return [
            'name'          => Str::slug($name),
            'readable_name' => $name,
            'guard_name' => 'api'
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name'          => 'admin',
                'readable_name' => 'Administrador'
            ];
        });
    }

    public function employee()
    {
        return $this->state(function (array $attributes) {
            return [
                'name'          => 'employee',
                'readable_name' => 'Empleado'
            ];
        });
    }

    public function client()
    {
        return $this->state(function (array $attributes) {
            return [
                'name'          => 'client',
                'readable_name' => 'Cliente'
            ];
        });
    }
}