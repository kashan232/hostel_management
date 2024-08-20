<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];

    // Define the relationship with the Floor model
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    // Define the relationship with the Room model
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
