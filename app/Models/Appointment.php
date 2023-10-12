<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'schedule',
        'status',
    ];

    public function technicians(): BelongsToMany
    {
        return $this->belongsToMany(Technician::class, 'appointment_technician');
    }
}
