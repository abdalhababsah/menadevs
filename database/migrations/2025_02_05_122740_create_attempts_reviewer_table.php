<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attempts_reviewer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('attempter_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating');
            $table->text('feedback');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('review_start_time')->nullable();
            $table->timestamp('review_end_time')->nullable();
            $table->integer('review_duration_seconds')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attempts_reviewer');
    }
};