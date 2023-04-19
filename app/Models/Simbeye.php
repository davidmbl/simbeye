<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simbeye extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scans()
    {
        return $this->hasMany(SimbeyeScans::class, 'rfid_id');
    }
}
