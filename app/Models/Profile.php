<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'tagline', 'bio', 'photo', 'cv_url', 'email', 'phone', 'location', 'github', 'linkedin', 'twitter', 'instagram'];
}
