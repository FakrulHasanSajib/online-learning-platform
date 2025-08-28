<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
       Schema::create('courses', function(Blueprint $t){
    $t->id();
    $t->foreignId('user_id')->constrained('users')->onDelete('cascade'); // teacher
    $t->string('title');
    $t->text('description');
    $t->timestamps();
});
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};