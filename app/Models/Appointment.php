<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Znck\Eloquent\Traits\BelongsToThrough;

class Appointment extends Model
{
    use HasFactory, BelongsToThrough;

    protected $fillable = [
        'service_id',
        'schedule',
        'status',
    ];

    protected $casts = [
        'schedule' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsToThrough(User::class, Service::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function technicians(): BelongsToMany
    {
        return $this->belongsToMany(Technician::class, 'appointment_technician');
    }
}
