<?php

namespace App\Models;

use App\Observers\DisplayObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([DisplayObserver::class])]
class Display extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'longitude',
        'latitude',
        'approved',
        'verified',
        'images',
        'website_uri',
        'public_email',
        'facebook_link',
        'twitter_link',
        'instagram_link',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'approved' => 'boolean',
            'verified' => 'boolean',
            'images' => 'array',
        ];
    }

    protected $appends = ['links'];

    public function scopeDistance($query, $lat, $lng, $radius = 100, $unit = 'km')
    {
        $unit = ($unit === 'km') ? 6371 : 3959;
        $lat = (float) $lat;
        $lng = (float) $lng;
        $radius = (double) $radius;
        return $query->having('distance', '<=', $radius)
            ->select(
                \Illuminate\Support\Facades\DB::raw("*,
                                ($unit * ACOS(COS(RADIANS($lat))
                                    * COS(RADIANS(latitude))
                                    * COS(RADIANS($lng) - RADIANS(longitude))
                                    + SIN(RADIANS($lat))
                                    * SIN(RADIANS(latitude)))) AS distance")
            )->orderBy('distance', 'asc');
    }

    public function workoutDistance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    public function links(): Attribute
    {
        $links = [];
        if (!is_null($this->website_uri)) {
            $links[] = [
                'icon' => 'website',
                'url' => $this->website_uri,
            ];
        }

        if (!is_null($this->facebook_link)) {
            $links[] = [
                'icon' => 'facebook',
                'url' => $this->facebook_link,
            ];
        }

        if (!is_null($this->twitter_link)) {
            $links[] = [
                'icon' => 'twitter',
                'url' => $this->twitter_link,
            ];
        }

        if (!is_null($this->instagram_link)) {
            $links[] = [
                'icon' => 'instagram',
                'url' => $this->instagram_link,
            ];
        }

        return Attribute::make(
            get: fn(mixed $value) => $links,
        );
    }
}
