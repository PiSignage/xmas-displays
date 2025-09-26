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
            'approved' => 'boolean',
            'verified' => 'boolean',
            'images' => 'array',
        ];
    }
}
