<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'description', 'photo', 'cat_id', 'location', 'organize_by'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organize_by');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
