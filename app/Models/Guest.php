<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    // In Guest.php model
    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floor_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // // In Guest.php
    // public function services()
    // {
    //     return $this->hasMany(GuestService::class);
    // }

    public function services()
    {
        return $this->hasMany(GuestService::class, 'guest_id');
    }

    // Guest.php

    public function servicesinvoice()
    {
        return $this->hasMany(GuestService::class);
    }

    public function getSeatsAttribute()
    {
        $seatIds = json_decode($this->seats_id, true); // Decode the JSON array
        if (is_array($seatIds) && !empty($seatIds)) {
            return Seat::whereIn('id', $seatIds)->get();
        }
        return collect(); // Return an empty collection if no seat IDs are found
    }

    public function guestservices()
    {
        return $this->hasMany(GuestService::class);
    }

    public function recurringServices()
    {
        return $this->hasMany(RecurringService::class);
    }
}
