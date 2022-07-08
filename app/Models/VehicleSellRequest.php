<?php

namespace App\Models;

use App\Notifications\EmailNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class VehicleSellRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'vehicle_sell_requests';
    protected $guarded = [];

    /* references */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    public function images()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_vehicle_request', 'sell_request_id');
    }
    
    public function interior_colors()
    {
        return $this->belongsToMany(Color::class, 'interior_color_vehicle_request', 'sell_request_id');
    }

     /* scopes */

     public function scopeSearch($query)
     {
         return $query->when(request()->filled('search'), function($query){
             $query->where('name', 'LIKE', '%'.request()->search.'%')
                 ->orWhere('last_name', 'LIKE', '%'.request()->search.'%')
                 ->orWhere('email', 'LIKE', '%'.request()->search.'%');
         });
     }


    /* methods */

    public function addImage()
    {

        if(request()->hasFile('file')){
            $file = request()->file('file');

            $path = $file->store('vehicle_sell_requests/'.$this->id, 'public');

            $this->images()->create([
                'path'     => $path,
                'filename' => $file->getClientOriginalName(),
                'name'     => $file->getClientOriginalName(),
            ]);
        }

        return $this;
    }

    public function sendAdminMail()
    {
        
        $subject = 'Se ha realizado una petición de venta';

        $content = $this->name.' '.$this->last_name.' Solicita vender su vehiculo';
        
        $users   = User::query()
            ->role('admin')
            ->select('id', 'email')
            ->get();

        Notification::send($users, new EmailNotification($subject, $content));

        return $this;   
    }

    public function setUser()
    {
        if(request()->filled('register') && request()->register == 'true'){
            
            $user = User::create([
                'name'      => request()->name,
                'email'     => request()->email,
                'password'  => request()->password,
                'client'    => true
            ]);
            
            $user->assignRole('client');
            
            Auth::login($user);
        }

        if(auth()->check()){
            $this->user_id = auth()->user()->id;
            $this->save();
        }

        return $this;
    }

    

}
