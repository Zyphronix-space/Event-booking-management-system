<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organizer extends Authenticatable
{
    use Notifiable;

    protected $table = 'organizer';
    protected $primaryKey = 'organizer_id';
    public $timestamps = false;

    protected $fillable = [
        'organizer_name',
        'contact_email',
        'contact_number',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'organizer_id', 'organizer_id');
    }
}
