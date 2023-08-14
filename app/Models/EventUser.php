<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;

    protected $table = 'event_user';

    protected $fillable = ['user_id', 'event_id', 'created_at', 'updated_at'];

    protected $withTimestamps = true;
}
