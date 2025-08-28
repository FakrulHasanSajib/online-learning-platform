<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

   public function courses(){ return $this->hasMany(Course::class); }   // as teacher
public function enrollments(){ return $this->belongsToMany(Course::class,'course_user'); } // as student
}