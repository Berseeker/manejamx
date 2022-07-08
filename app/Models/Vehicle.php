<?php

namespace App\Models;

use App\Jobs\VehicleImageFolderOptimizeJob;
use Carbon\Carbon;
use Davidcb\LaravelShortPixel\Facades\LaravelShortPixel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /* relations */

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function status()
    {
        return $this->belongsTo(VehicleStatus::class);
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    public function body_type()
    {
        return $this->belongsTo(BodyType::class);
    }

    public function transmissions()
    {
        return $this->belongsToMany(Transmission::class);
    }

    public function cylinders()
    {
        return $this->belongsToMany(Cylinder::class);
    }

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class);
    }

    public function fuels()
    {
        return $this->belongsToMany(Fuel::class);
    }

    public function drives()
    {
        return $this->belongsToMany(Drive::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function interior_colors()
    {
        return $this->belongsToMany(Color::class, 'interior_color_vehicle');
    }

    public function images()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function principal_images()
    {
        return $this->morphMany(File::class, 'fileable')->where('type_id', FileType::PRINCIPAL)->orderBy('order');
    }

    public function three_sixty_images()
    {
        return $this->morphMany(File::class, 'fileable')->where('type_id', FileType::THREE_SIXTY);
    }

    public function interior_images()
    {
        return $this->morphMany(File::class, 'fileable')->where('type_id', FileType::INTERIOR)->orderBy('order');
    }

    public function exterior_images()
    {
        return $this->morphMany(File::class, 'fileable')->where('type_id', FileType::EXTERIOR)->orderBy('order');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function inspections()
    {
        return $this->belongsToMany(Inspection::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function quote_requests()
    {
        return $this->hasMany(VehicleQuoteRequest::class);
    }

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /* scopes */

    public function scopeOrdered($query)
    {
        $query->when(request()->filled('order_by'), function($query){
            $query->orderBy(request()->order_by, request()->order);
        });
    }

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->whereHas('brand', function($query){
                $query->where('name', 'LIKE', '%'.request()->search.'%');
            })
            ->orWhereHas('model', function($query){
                $query->where('name', 'LIKE', '%'.request()->search.'%');
            })
            ->orWhereHas('version', function($query){
                $query->where('name', 'LIKE', '%'.request()->search.'%');
            });
        });
    }


    public function scopePriceRange($query)
    {
        return $query->when(request()->filled('price'), function($query){
            $query->whereBetween('sell_price', request()->price);
        });
    }

    public function scopeYearRange($query)
    {
        return $query->when(request()->filled('year'), function($query){
            $query->whereBetween('year', request()->year);
        });
    }

    public function scopeOdometerRange($query)
    {
        return $query->when(request()->filled('odometer'), function($query){
            $query->whereBetween('odometer', request()->odometer);
        });
    }

    public function scopeBodyTypeIn($query)
    {
        return $query->when(request()->filled('body_types'), function($query){
            $query->whereIn('body_type_id', request()->body_types);
        });
    }

    public function scopeModelIn($query)
    {
        return $query->when(request()->filled('models'), function($query){
            $query->whereIn('model_id', request()->models);
        });
    }

    public function scopeAccessoryIn($query)
    {
        return $query->when(request()->filled('accessories'), function($query){
            $query->whereHas('accessories', function($query){
                $query->whereIn('accessory_id', request()->accessories);
            });
        });
    }

    public function scopeAccessories($query)
    {
        return $query->when(request()->filled('accessories'), function($query){

            $query->whereHas('accessories', function($query){
                    foreach(request()->accessories as $accessory){
                        $query->where('accessory_id', $accessory);
                    }
                });
        });
    }

    public function scopeFuelIn($query)
    {
        return $query->when(request()->filled('fuels'), function($query){
            $query->whereHas('fuels', function($query){
                $query->whereIn('fuel_id', request()->fuels);
            });
        });
    }

    public function scopeCylinderIn($query)
    {
        return $query->when(request()->filled('cylinders'), function($query){
            $query->whereHas('cylinders', function($query){
                $query->whereIn('cylinder_id', request()->cylinders);
            });
        });
    }

    public function scopeColorIn($query)
    {
        return $query->when(request()->filled('colors'), function($query){
            $query->whereHas('colors', function($query){
                $query->whereIn('color_id', request()->colors);
            });
        });
    }

    public function scopeTransmissionIn($query)
    {
        return $query->when(request()->filled('transmissions'), function($query){
            $query->whereHas('transmissions', function($query){
                $query->whereIn('transmission_id', request()->transmissions);
            });
        });
    }

    public function scopeDriveIn($query)
    {
        return $query->when(request()->filled('drives'), function($query){
            $query->whereHas('drives', function($query){
                $query->whereIn('drive_id', request()->drives);
            });
        });
    }

    public function scopeBrandId($query)
    {
        return $query->when(request()->filled('brand_id'), function($query){
            $query->where('brand_id', request()->brand_id);
        });
    }

    public function scopeModelId($query)
    {
        return $query->when(request()->filled('model_id'), function($query){
            $query->where('model_id', request()->model_id);
        });
    }

    public function scopeStatusId($query)
    {
        return $query->when(request()->filled('status_id'), function($query){
            $query->where('status_id', request()->status_id);
        });
    }

    public function scopeFuelId($query)
    {
        return $query->when(request()->filled('fuel_id'), function($query){
            $query->whereHas('fuels', function($query){
                $query->where('fuel_id', request()->fuel_id);
            });
        });
    }

    public function scopeCylinderId($query)
    {
        return $query->when(request()->filled('cylinder_id'), function($query){
            $query->whereHas('cylinders', function($query){
                $query->where('cylinder_id', request()->cylinder_id);
            });
        });
    }

    public function scopeTransmissionId($query)
    {
        return $query->when(request()->filled('transmission_id'), function($query){
            $query->whereHas('transmissions', function($query){
                $query->where('transmission_id', request()->transmission_id);
            });
        });
    }

    public function scopeLikedByUser($query)
    {
        return $query->when(request()->liked_by_user == 'true', function($query){
            $query->whereHas('likes', function($likes){
                $likes->where('user_id', auth('api')->user()->id);
            });
        });
    }

    public function scopeViewedByUser($query)
    {
        return $query->when(request()->viewed_by_user == 'true', function($query){
            $query->whereHas('views', function($views){
                $views->where('user_id', auth('api')->user()->id);
            });
        });
    }

    public function scopeAffiliate($query)
    {
        return $query->when(request()->filled('affiliate'), function ($q) {
            $affiliate = Affiliate::query()->where('url', request('affiliate'))->first();

            if($affiliate) {
                $q->where('affiliate_id', $affiliate->id);
            }
        });
    }


    /* methods */

    public function addImages()
    {
        if(request()->hasFile('files')){

            foreach(request()->file('files') as $file)
            {

                $fileName      = '';
                $path          = '';
                //$newfileName = '';
                //$newPath     = '';

                if(request()->type_id == FileType::PRINCIPAL){
                    $fileName = $file->getClientOriginalName();
                    //$fileName = ($this->principal_images->count() + 1).'.'.$file->extension();
                    $path     = $file->storeAs('vehicles/'.$this->id.'/images/principal', $fileName, 'public');
                    //$result   = LaravelShortPixel::fromFiles(storage_path('app/public/'.$path), storage_path('app/public/vehicles/'.$this->id.'/images/principal'), []);
                }

                if(request()->type_id == FileType::THREE_SIXTY){
                    $fileName = ($this->three_sixty_images->count() + 1).'.'.$file->extension();
                    $path     = $file->storeAs('vehicles/'.$this->id.'/images/360', $fileName, 'public');
                    //$result   = LaravelShortPixel::fromFiles(storage_path('app/public/'.$path), storage_path('app/public/vehicles/'.$this->id.'/images/360'), []);
                }

                if(request()->type_id == FileType::EXTERIOR){
                    $fileName = $file->getClientOriginalName();
                    $path     = $file->storeAs('vehicles/'.$this->id.'/images/exterior', $fileName, 'public');
                    //$result   = LaravelShortPixel::fromFiles(storage_path('app/public/'.$path), storage_path('app/public/vehicles/'.$this->id.'/images/exterior'), []);
                }

                if(request()->type_id == FileType::INTERIOR){
                    $fileName = $file->getClientOriginalName();
                    $path     = $file->storeAs('vehicles/'.$this->id.'/images/interior', $fileName, 'public');
                    //$result   = LaravelShortPixel::fromFiles(storage_path('app/public/'.$path), storage_path('app/public/vehicles/'.$this->id.'/images/interior'), []);
                }

                $image = $this->images()->create([
                    'type_id'     => request()->type_id,
                    'description' => request()->description,
                    'path'        => $path,
                    'filename'    => $fileName,
                    'name'        => $fileName,
                ]);
            }

            if(request()->type_id == FileType::PRINCIPAL){
                VehicleImageFolderOptimizeJob::dispatch(storage_path('app/public/vehicles/'.$this->id.'/images/principal'));
            }

            if(request()->type_id == FileType::THREE_SIXTY){
                VehicleImageFolderOptimizeJob::dispatch(storage_path('app/public/vehicles/'.$this->id.'/images/360'));
            }

            if(request()->type_id == FileType::EXTERIOR){
                VehicleImageFolderOptimizeJob::dispatch(storage_path('app/public/vehicles/'.$this->id.'/images/exterior'));
            }

            if(request()->type_id == FileType::INTERIOR){
                VehicleImageFolderOptimizeJob::dispatch(storage_path('app/public/vehicles/'.$this->id.'/images/interior'));
            }

        }

        return $this;
    }


    public function toggleLike()
    {
        if ($like = $this->likes()->where('user_id', auth('api')->user()->id)->first()) {
            $like->delete();
        } else {
            $this->likes()->create([
                'user_id' => auth('api')->user()->id
            ]);
        }
    }

    public function liked()
    {
        if (auth('api')->user()) {
            return $this->likes()->where('user_id', auth('api')->user()->id)->exists();
        }
        return false;
    }

    public function addView()
    {
        $view = View::whereDate('created_at', Carbon::today())
            ->where('ip', $ip = request()->ip())
            ->where('vehicle_id', $this->id)
            ->exists();

        if (!$view) {
            return $this->views()->create([
                'user_id' => auth('api')->user() ? auth('api')->user()->id : null,
                'ip'      => $ip
            ]);
        }

        return false;
    }

    public function getFullName(): string
    {
        return $this->year.' '.$this->brand->name.' '.$this->model->name;
    }

    public function getSlug(): string
    {
        $value = $this->year.'-'.$this->brand->name.'-'.$this->model->name.'-'.$this->id;

        return Str::slug($value);
    }
}
