<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_dimensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('dimension_id')->constrained('dimensions')->onDelete('cascade');
            $table->enum('rating', ['major_issue', 'minor_issue', 'partially_fulfilled', 'completely_fulfilled'])->nullable();
            $table->text('justification_response_2')->nullable();
            $table->text('justification_response_1')->nullable();
            $table->foreignId('filled_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_dimensions');
    }
};
