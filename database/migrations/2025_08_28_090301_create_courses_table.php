<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Teacher's ID
            $table->string('title');
            $table->text('description');
            $table->string('cover_image')->nullable(); // Course thumbnail/cover
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};