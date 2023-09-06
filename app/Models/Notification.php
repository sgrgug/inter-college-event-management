<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillabel = [
        'type',
        'title',
        'message',
        'user_id',
        'event_id',
        'org_id',
        'noti_to_user',
        'read',
    ];
}
