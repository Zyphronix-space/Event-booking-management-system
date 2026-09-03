<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'event_id';
    public $timestamps = false;

    protected $fillable = [
        'event_name',
        'event_date',
        'venue',
        'category',
        'ticket_price',
        'organizer_id',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class, 'organizer_id', 'organizer_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'event_id', 'event_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'event_id', 'event_id');
    }
}
