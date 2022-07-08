<?php

namespace Tests\Feature\Site;

use App\Models\Color;
use App\Models\User;
use App\Models\VehicleSellRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class VehicleSellRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_sell_vehicle_request()
    {
        Storage::fake('public');
        Mail::fake();

        $this->signIn();

        $data  = VehicleSellRequest::factory()->create();
        $color = Color::factory()->create();

        $parameters = [
            'name'            => $data->name,
            'last_name'       => $data->last_name,
            'phone'           => $data->phone,
            'email'           => $data->email,
            'brand_id'        => $data->brand->id,
            'model_id'        => $data->model->id,
            'version_id'      => $data->version->id,
            'user_id'         => $data->user->id,
            'year'            => $data->year,
            'odometer'        => $data->odometer,
            'sell_price'      => $data->sell_price,
            'colors'          => [$color->id],
            'interior_colors' => [$color->id],
            'file'            => UploadedFile::fake()->image('test.jpg'),
        ];


        $this->postJson('/api/vehicle-sell-requests', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name'            => $data->name,
                    'last_name'       => $data->last_name,
                    'phone'           => $data->phone,
                    'email'           => $data->email,
                    'year'            => $data->year,
                    'odometer'        => $data->odometer,
                    'sell_price'      => $data->sell_price,
                ]
            ]);

        $this->assertDatabaseHas('vehicle_sell_requests', [
            'name'            => $data->name,
            'last_name'       => $data->last_name,
            'phone'           => $data->phone,
            'email'           => $data->email,
            'brand_id'        => $data->brand->id,
            'model_id'        => $data->model->id,
            'version_id'      => $data->version->id,
            'year'            => $data->year,
            'odometer'        => $data->odometer,
            'sell_price'      => $data->sell_price,
            'user_id'         => $data->user->id,
        ]);

        $this->assertDatabaseHas('interior_color_vehicle_request', [
            'sell_request_id' => VehicleSellRequest::max('id'),
            'color_id'   => $color->id
        ]);
        
        $this->assertDatabaseHas('color_vehicle_request', [
            'sell_request_id' => VehicleSellRequest::max('id'),
            'color_id'   => $color->id
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => VehicleSellRequest::max('id'),
            'fileable_type' => VehicleSellRequest::class,
            'name'          => 'test.jpg',
            'filename'      => 'test.jpg',
        ]);
    }
    
    public function test_store_sell_vehicle_request_without_user()
    {
        Storage::fake('public');
        Mail::fake();

        $data  = VehicleSellRequest::factory()->create();
        $color = Color::factory()->create();

        $parameters = [
            'name'            => $data->name,
            'last_name'       => $data->last_name,
            'phone'           => $data->phone,
            'email'           => $data->email,
            'brand_id'        => $data->brand->id,
            'model_id'        => $data->model->id,
            'version_id'      => $data->version->id,
            'year'            => $data->year,
            'odometer'        => $data->odometer,
            'sell_price'      => $data->sell_price,
            'colors'          => [$color->id],
            'interior_colors' => [$color->id],
            'file'            => UploadedFile::fake()->image('test.jpg'),
        ];


        $this->postJson('/api/vehicle-sell-requests', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name'            => $data->name,
                    'last_name'       => $data->last_name,
                    'phone'           => $data->phone,
                    'email'           => $data->email,
                    'year'            => $data->year,
                    'odometer'        => $data->odometer,
                    'sell_price'      => $data->sell_price,
                ]
            ]);

        $this->assertDatabaseHas('vehicle_sell_requests', [
            'name'            => $data->name,
            'last_name'       => $data->last_name,
            'phone'           => $data->phone,
            'email'           => $data->email,
            'brand_id'        => $data->brand->id,
            'model_id'        => $data->model->id,
            'version_id'      => $data->version->id,
            'year'            => $data->year,
            'odometer'        => $data->odometer,
            'sell_price'      => $data->sell_price,
        ]);

        $this->assertDatabaseHas('interior_color_vehicle_request', [
            'sell_request_id' => VehicleSellRequest::max('id'),
            'color_id'   => $color->id
        ]);
        
        $this->assertDatabaseHas('color_vehicle_request', [
            'sell_request_id' => VehicleSellRequest::max('id'),
            'color_id'   => $color->id
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => VehicleSellRequest::max('id'),
            'fileable_type' => VehicleSellRequest::class,
            'name'          => 'test.jpg',
            'filename'      => 'test.jpg',
        ]);
    }
    
    public function test_store_sell_vehicle_request_with_user_registration()
    {
        $this->withoutExceptionHandling();
        Storage::fake('public');
        Mail::fake();

        $data  = VehicleSellRequest::factory()->create();
        $color = Color::factory()->create();

        $parameters = [
            'name'                  => $data->name,
            'last_name'             => $data->last_name,
            'phone'                 => $data->phone,
            'email'                 => $data->email,
            'brand_id'              => $data->brand->id,
            'model_id'              => $data->model->id,
            'version_id'            => $data->version->id,
            'year'                  => $data->year,
            'odometer'              => $data->odometer,
            'sell_price'            => $data->sell_price,
            'colors'                => [$color->id],
            'interior_colors'       => [$color->id],
            'password'              => 'password',
            'password_confirmation' => 'password',
            'file'                  => UploadedFile::fake()->image('test.jpg'),
            'register'              => true
        ];

        $this->postJson('/api/vehicle-sell-requests', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name'       => $data->name,
                    'last_name'  => $data->last_name,
                    'phone'      => $data->phone,
                    'email'      => $data->email,
                    'year'       => $data->year,
                    'odometer'   => $data->odometer,
                    'sell_price' => $data->sell_price,
                ]
            ]);

        $this->assertDatabaseHas('vehicle_sell_requests', [
            'name'       => $data->name,
            'last_name'  => $data->last_name,
            'phone'      => $data->phone,
            'email'      => $data->email,
            'brand_id'   => $data->brand->id,
            'model_id'   => $data->model->id,
            'version_id' => $data->version->id,
            'year'       => $data->year,
            'odometer'   => $data->odometer,
            'sell_price' => $data->sell_price,
            'user_id'    => User::max('id')
        ]);

        $this->assertCredentials([
            'email'    => $data->email,
            'password' => 'password'
        ]);

        $this->assertDatabaseHas('interior_color_vehicle_request', [
            'sell_request_id' => VehicleSellRequest::max('id'),
            'color_id'        => $color->id
        ]);
        
        $this->assertDatabaseHas('color_vehicle_request', [
            'sell_request_id' => VehicleSellRequest::max('id'),
            'color_id'        => $color->id
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => VehicleSellRequest::max('id'),
            'fileable_type' => VehicleSellRequest::class,
            'name'          => 'test.jpg',
            'filename'      => 'test.jpg',
        ]);
    }
    
    public function test_validate_store_sell_vehicle_request()
    {

        $parameters = [];

        $this->postJson('/api/vehicle-sell-requests', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'            => ['El campo nombre es obligatorio.'],
                    'last_name'       => ['El campo apellido es obligatorio.'],
                    'phone'           => ['El campo teléfono es obligatorio.'],
                    'email'           => ['El campo correo electrónico es obligatorio.'],
                    'brand_id'        => ['El campo marca es obligatorio.'],
                    'model_id'        => ['El campo modelo es obligatorio.'],
                    'version_id'      => ['El campo versión es obligatorio.'],
                    'year'            => ['El campo año es obligatorio.'],
                    'odometer'        => ['El campo kilometraje es obligatorio.'],
                    'sell_price'      => ['El campo precio de venta es obligatorio.'],
                    'colors'          => ['El campo color exterior es obligatorio.'],
                    'interior_colors' => ['El campo color del interior es obligatorio.'],
                    'file'            => ['El campo imagen es obligatorio.'],
                ]
            ]);

    }
    
    public function test_validate_store_sell_vehicle_request_with_register_user()
    {

        $parameters = ['register' => true];

        $this->postJson('/api/vehicle-sell-requests', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'            => ['El campo nombre es obligatorio.'],
                    'last_name'       => ['El campo apellido es obligatorio.'],
                    'phone'           => ['El campo teléfono es obligatorio.'],
                    'email'           => ['El campo correo electrónico es obligatorio.'],
                    'brand_id'        => ['El campo marca es obligatorio.'],
                    'model_id'        => ['El campo modelo es obligatorio.'],
                    'version_id'      => ['El campo versión es obligatorio.'],
                    'year'            => ['El campo año es obligatorio.'],
                    'odometer'        => ['El campo kilometraje es obligatorio.'],
                    'sell_price'      => ['El campo precio de venta es obligatorio.'],
                    'colors'          => ['El campo color exterior es obligatorio.'],
                    'interior_colors' => ['El campo color del interior es obligatorio.'],
                    'password'        => ['El campo contraseña es obligatorio cuando selecciona registrar.'],
                    'file'            => ['El campo imagen es obligatorio.'],
                ]
            ]);

    }

}
