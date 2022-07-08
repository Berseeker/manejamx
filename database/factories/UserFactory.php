<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => 'password',
            'api_token' => Str::random(100),
            'remember_token' => Str::random(10)
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'client'    => false
            ];
        })->afterCreating(function(User $user) {
            $user->assignRole('admin');
        });
    }

    public function employee()
    {
        return $this->state(function (array $attributes) {
            return [
                'client'    => false
            ];
        })->afterCreating(function(User $user) {
            $user->assignRole('employee');
        });
    }

    public function client()
    {
        return $this->state(function (array $attributes) {
            return [
                'client'    => true
            ];
        })->afterCreating(function(User $user) {
            $user->assignRole('client');
        });
    }
}