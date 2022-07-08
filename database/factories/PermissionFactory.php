<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
        $name = $this->faker->word;
        return [
            'name'          => $name,
            'guard_name'    => 'api'
        ];
    }
}