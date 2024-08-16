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

    // In Guest.php
    public function services()
    {
        return $this->hasMany(GuestService::class);
    }
    
    
}
