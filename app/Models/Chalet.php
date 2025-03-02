<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chalet extends Model
{
    use SoftDeletes;

    
    protected $guarded=[];
    use HasFactory;
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
}
