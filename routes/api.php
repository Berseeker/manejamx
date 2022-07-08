<?php

use App\Http\Controllers\Api\Admin\Affiliates\LevelController;
use App\Http\Controllers\Api\Admin\Affiliates\AffiliateController as AdminAffiliateController;
use App\Http\Controllers\Api\Admin\Affiliates\ApprobationController;
use App\Http\Controllers\Api\Admin\Affiliates\RejectionController;
use App\Http\Controllers\Api\Admin\Affiliates\VehicleApprobationController;
use App\Http\Controllers\Api\Admin\Affiliates\VehicleController as AdminVehicleController;
use App\Http\Controllers\Api\Admin\Affiliates\VehicleRejectionController;
use App\Http\Controllers\Api\Site\Affiliates\AffiliateController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\Site\Affiliates\VehicleController;
use Illuminate\Support\Facades\Route;


Route::namespace('Api')->group(function(){

    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function ()
    {
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{post}', [PostController::class, 'show']);
    });

    Route::post('contacts', 'ContactController@store');
    Route::get('models', 'ModelController@index');
    Route::get('brands', 'BrandController@index');
    Route::get('versions', 'VersionController@index');
    Route::get('transmissions', 'TransmissionController@index');
    Route::get('cylinders', 'CylinderController@index');
    Route::get('accessory-types', 'AccessoryTypeController@index');
    Route::get('accessories', 'AccessoryController@index');
    Route::get('fuels', 'FuelController@index');
    Route::get('body-types', 'BodyTypeController@index');
    Route::get('vehicle-sides', 'VehicleSideController@index');
    Route::get('colors', 'ColorController@index');
    Route::get('drives', 'DriveController@index');
    Route::get('vehicles', 'VehicleController@index');
    Route::get('vehicles/{vehicle}', 'VehicleController@show');

    Route::post('vehicles/{vehicle}/views', 'ViewController@store');
    Route::post('vehicles/{vehicle}/quote-requests', 'VehicleQuoteRequestController@store');
    Route::post('vehicle-sell-requests', 'VehicleSellRequestController@store');
    Route::get('blue-book/versions/{version}', 'BlueBookVersionPriceController@show');

    Route::get('affiliates/{profile}', [AffiliateController::class, 'show']);
    Route::post('affiliates', [AffiliateController::class, 'store']);

    Route::middleware('auth:api')->group(function(){

        Route::put('vehicles/{vehicle}/likes', 'LikeController@update');

        Route::namespace('Admin')->prefix('admin')->group(function(){

            Route::namespace('Blog')->prefix('blog')->group(function(){
                Route::apiResource('categories', 'CategoryController');
                Route::apiResource('posts', 'PostController');
            });

            Route::apiResource('vehicles/quote-requests', 'VehicleQuoteRequestController');
            Route::apiResource('vehicles/sell-requests', 'VehicleSellRequestController');
            Route::apiResource('roles', 'RoleController');
            Route::apiResource('permissions', 'PermissionController');
            Route::apiResource('users', 'UserController');
            Route::apiResource('clients', 'ClientController');
            Route::apiResource('years', 'YearController');
            Route::apiResource('brands', 'BrandController');
            Route::apiResource('transmissions', 'TransmissionController');
            Route::put('transmissions/{transmission_id}/restorations', 'RestoreTransmissionController@update');
            Route::apiResource('cylinders', 'CylinderController');
            Route::put('cylinders/{cylinder_id}/restorations', 'RestoreCylinderController@update');
            Route::apiResource('accessory-types', 'AccessoryTypeController');
            Route::put('accessory-types/{type_id}/restorations', 'RestoreAccessoryTypeController@update');
            Route::apiResource('accessories', 'AccessoryController');
            Route::put('accessories/{accessory_id}/restorations', 'RestoreAccessoryController@update');
            Route::apiResource('fuels', 'FuelController');
            Route::put('fuels/{fuel_id}/restorations', 'RestoreFuelController@update');
            Route::apiResource('drives', 'DriveController');
            Route::put('drives/{drive}/restorations', 'RestoreDriveController@update');
            Route::apiResource('body-types', 'BodyTypeController');
            Route::put('body-types/{body_type_id}/restorations', 'RestoreBodyTypeController@update');
            Route::apiResource('models', 'ModelController');
            Route::apiResource('versions', 'VersionController');
            Route::apiResource('vehicle-sides', 'VehicleSideController');
            Route::apiResource('file-types', 'FileTypeController');
            Route::apiResource('colors', 'ColorController');
            Route::put('colors/{color}/restorations', 'RestoreColorController@update');
            Route::apiResource('vehicles', 'VehicleController');
            Route::put('vehicles/{vehicle}/change-statuses', 'VehicleChangeStatusController@update');
            Route::put('vehicles/{vehicle}/activations', 'VehicleActivateController@update');
            Route::get('vehicle-statuses', 'VehicleStatusController@index');
            Route::post('vehicles/{vehicle}/details', 'VehicleDetailController@store');
            Route::post('vehicles/{vehicle}/accessories', 'VehicleAccessoryController@store');
            Route::post('vehicles/{vehicle}/images', 'VehicleImageController@store');
            Route::put('vehicles/{vehicle}/order-images', 'VehicleOrderImageController@update');
            Route::delete('vehicles/{vehicle}/images/{file}', 'VehicleImageController@destroy');
            Route::delete('files/{file}', 'FileController@destroy');
            Route::apiResource('inspections', 'InspectionController');
            Route::put('inspections/{inspection}/restorations', 'RestoreInspectionController@update');
            Route::post('vehicles/{vehicle}/inspections', 'VehicleInspectionController@store');
            Route::get('external-vehicles', 'ExternalVehicleController@index');

            Route::post('affiliates/{affiliate}/approbations', [ApprobationController::class, 'store']);
            Route::post('affiliates/{affiliate}/rejections', [RejectionController::class, 'store']);

            Route::delete('affiliates/levels/{level}', [LevelController::class, 'destroy']);
            Route::put('affiliates/levels/{level}', [LevelController::class, 'update']);
            Route::get('affiliates/levels', [LevelController::class, 'index']);
            Route::post('affiliates/levels', [LevelController::class, 'store']);

            Route::get('affiliates/vehicles', [AdminVehicleController::class, 'index']);

            Route::post('affiliates/vehicles/{vehicle}/rejections', [VehicleRejectionController::class, 'store']);
            Route::post('affiliates/vehicles/{vehicle}/approbations', [VehicleApprobationController::class, 'store']);

            Route::get('affiliates', [AdminAffiliateController::class, 'index']);
        });

        Route::namespace('Site')->prefix('site')->group(function(){
            Route::namespace('User')->group(function(){
                Route::put('users/{user}/personal-details', 'PersonalDetailController@update');
                Route::put('users/{user}/password', 'PasswordController@update');
                Route::put('users/{user}/toggle-notifications', 'NotificationController@update');
                Route::post('users/{user}/filters', 'FilterController@store');
            });

            Route::namespace('Affiliates')->group(function(){
                Route::get('affiliates/vehicles', [VehicleController::class, 'index']);
                Route::post('affiliates/vehicles', [VehicleController::class, 'store']);
            });
        });

        Route::namespace('Site')->prefix('site')->group(function(){
            Route::namespace('User\Filters')->group(function(){
                Route::apiResource('filters', 'FilterController');
            });
        });
    });

});
