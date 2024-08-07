<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory, BelongsToThrough;

    protected $fillable = [
        'service_id',
        'schedule',
        'status',
        'propose_reschedule'
    ];

    protected $casts = [
        'schedule' => 'datetime',
        'propose_reschedule' => 'datetime'
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

    public function scopeWhereStatus(Builder $query, string $status1, ?string $status2 = null)
    {
        return $query->where('status', $status1)->when($status2, function ($query) use ($status2) {
            $query->orWhere('status', $status2);
        });
    }

    public function scopeForTechnicianUser(Builder $query, int $userId)
    {
        return $query->whereHas('technicians', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    public function scopeForServiceUser(Builder $query, int $userId)
    {
        return $query->whereRelation('service', 'user_id', $userId);
    }
}
