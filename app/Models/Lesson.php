<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Lesson extends Model {
    protected $guarded = [];
    public function course() { return $this->belongsTo(Course::class); }
    public function completedByUsers() { return $this->belongsToMany(User::class, 'lesson_user')->withTimestamps(); }
}