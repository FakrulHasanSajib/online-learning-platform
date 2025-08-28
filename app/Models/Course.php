<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Course extends Model {
    protected $guarded = [];
    public function teacher() { return $this->belongsTo(User::class, 'user_id'); }
    public function lessons() { return $this->hasMany(Lesson::class); }
    public function students() { return $this->belongsToMany(User::class, 'course_user'); }
}