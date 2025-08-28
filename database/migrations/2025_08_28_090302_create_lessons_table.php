<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
      Schema::create('lessons',function(Blueprint $t){
    $t->id();
    $t->foreignId('course_id')->constrained()->onDelete('cascade');
    $t->string('title');
    $t->longText('content');
    $t->timestamps();
});
    }
    public function down(): void { Schema::dropIfExists('lessons'); }
};