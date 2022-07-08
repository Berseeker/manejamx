<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::name('site.')->group(function(){
    Route::get('/', function () {return view('welcome');});
    Route::view('autos', 'site.cars.index')->name('cars.index');
    Route::get('autos/{vehicleSlug}', 'VehicleController@show')->name('vehicle.show');
    Route::view('autos/{vehicle}/cotizar', 'site.cars.quote')->name('vehicle.quote');
    Route::view('como-funciona', 'site.how_it_works')->name('how-it-works');
    Route::view('vender-mi-auto', 'site.sell')->name('sell-my-car');
    Route::get('nosotros', 'Web\Site\AboutUsController@index')->name('about-us');
    Route::view('calculadora', 'site.loan_calculator')->name('loan-calculator');
    Route::get('usuarios/perfil', 'Web\Site\User\ProfileController@index')->name('users.profile');
    Route::view('terminos', 'site.terms-of-use')->name('terms-of-use');
    Route::view('contacto', 'site.contact')->name('contact');
    Route::post('formulario-de-contacto', 'Web\Site\ContactFormController@store');
    Route::view('aviso-de-privacidad', 'site.privacy_policy')->name('privacy-policy');
    Route::view('blog', 'site.blog.index')->name('blog');
    Route::get('blog/{post}/{slug}', [PostController::class, 'show'])->name('blog.post');
    Route::view('afiliados/registro', 'site.affiliates.register');
    Route::view('afiliados', 'site.affiliates.index');
});


Route::middleware(['auth', 'role:admin|employee'])->group(function(){
    Route::get('/admin', 'Web\HomeController@index')->name('home');
    Route::namespace('Admin')->prefix('admin')->group(function(){
        Route::prefix('blog')->group(function(){
            Route::view('categories', 'admin.blog.categories.index')->name('admin.blog.categories');
            Route::view('posts', 'admin.blog.posts.index')->name('admin.blog.posts');
            Route::view('posts/create', 'admin.blog.posts.create')->name('admin.blog.create');
            Route::view('posts/edit/{post}', 'admin.blog.posts.edit')->name('admin.blog.edit');
        });
        Route::view('roles', 'admin.roles.index')->name('admin.roles');
        Route::view('permissions', 'admin.permissions.index')->name('admin.permissions');
        Route::view('users', 'admin.users.index')->name('admin.users');
        Route::view('clients', 'admin.clients.index')->name('admin.clients');
        Route::view('brands', 'admin.brands.index')->name('admin.brands');
        Route::view('transmissions', 'admin.transmissions.index')->name('admin.transmissions');
        Route::view('cylinders', 'admin.cylinders.index')->name('admin.cylinders');
        Route::view('accessory-types', 'admin.accessories.types')->name('admin.accessory_types');
        Route::view('accessories', 'admin.accessories.index')->name('admin.accessories');
        Route::view('fuels', 'admin.fuels.index')->name('admin.fuels');
        Route::view('body-types', 'admin.body_types.index')->name('admin.body_types');
        Route::view('models', 'admin.models.index')->name('admin.models');
        Route::view('versions', 'admin.versions.index')->name('admin.versions');
        Route::view('vehicle-sides', 'admin.vehicle_sides.index')->name('admin.vehicle_sides');
        Route::view('colors', 'admin.colors.index')->name('admin.colors');
        Route::view('drives', 'admin.drives.index')->name('admin.drives');
        Route::view('vehicles', 'admin.vehicles.index')->name('admin.vehicles.index');
        Route::view('vehicles/create', 'admin.vehicles.create')->name('admin.vehicles.create');
        Route::view('quote-requests', 'admin.vehicles.quote_requests')->name('admin.quote_requests');
        Route::view('vehicles/{vehicle}', 'admin.vehicles.edit')->name('admin.vehicles.edit');
        Route::view('inspections', 'admin.inspections.index')->name('admin.inspections');
        Route::view('sell-requests', 'admin.vehicles.sell_requests')->name('admin.sell_requests');
        Route::view('prices', 'admin.prices.index')->name('admin.prices');
        Route::view('affiliates/levels', 'admin.affiliates.levels');
        Route::view('affiliates/vehicles', 'admin.affiliates.vehicles');
        Route::view('affiliates', 'admin.affiliates.index');
    });
});
