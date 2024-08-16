<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    
    // In GuestService.php
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
}
