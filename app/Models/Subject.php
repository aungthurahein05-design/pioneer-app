<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Subject extends Model
{
    protected $fillable = ['name'];

    // ✅ Subject has many Events
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
