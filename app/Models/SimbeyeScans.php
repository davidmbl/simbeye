<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimbeyeScans extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rfid()
    {
        return $this->belongsTo(Simbeye::class, 'rfid_id');
    }
}
