<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{  
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function ownerProfile()
    {
        return $this->hasOne(Owner_Profile::class);
    }

    public function chalets()
    {
        return $this->hasMany(Chalet::class, 'owner_id');
    }
    
public function index()
{
    $totalUsers = User::count();

    return view('your-view-name', compact('totalUsers'));

          // Get the total number of users and owners (excluding admins)
    // $totalUsersAndOwners = User::whereIn('role', ['user', 'owner'])->count();

    // Pass the data to the view
    // return view('your-view-name', compact('totalUsersAndOwners'));
}
}
