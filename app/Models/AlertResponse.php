<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertResponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sendTime',
        'eventId',
        'eventType',
        'status',
        'human_id',
        'name',
        'wearMaskStatus',
        'response_data',
    ];
    
    protected $casts = [
        'response_data' => 'array',
    ];
}
