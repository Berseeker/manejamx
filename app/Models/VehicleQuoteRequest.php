<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;

class VehicleQuoteRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'vehicle_quote_requests';
    protected $guarded = [];

    /* relations */

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
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

    public function sendAdminMail()
    {

        $subject = 'Se ha realizado una petición de cita';

        $content = $this->name.' '.$this->last_name.' Solicita mas información sobre el vehiculo';

        $url = route('site.vehicle.show', $this->vehicle_id);

        $urlMessage = 'Ver vehículo';

        $users   = User::query()
            ->role('admin')
            ->select('id', 'email')
            ->get();

        Notification::send($users, new EmailNotification($subject, $content, $url, $urlMessage));

        return $this;
    }
}
