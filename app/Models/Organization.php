<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\User;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description', 'photo', 'location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
