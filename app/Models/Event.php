<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'event_date',
        'event_is_virtual',
        'event_speaker_name',
        'fk_venue_event',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_is_virtual' => 'boolean',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'fk_venue_event');
    }
}