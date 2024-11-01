<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function thanas()
    {
        return $this->belongsToMany(Thana::class, 'service_thana');
    }
}
