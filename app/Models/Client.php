<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'telephone',
        'alamat',
    ];

    /**
     * Get the clien's gender.
     */
    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value == "L" ? "Laki-laki" : ($value == 'P' ? "Perempuan" : null),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
