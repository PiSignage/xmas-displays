<?php

namespace App\Models;

use App\Observers\DisplayObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([DisplayObserver::class])]
class Display extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'longitude',
        'latitude',
        'approved',
        'verified',
        'images',
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
}
