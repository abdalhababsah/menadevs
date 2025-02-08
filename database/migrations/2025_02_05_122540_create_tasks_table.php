<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_task_id')->nullable()->constrained('tasks')->onDelete('cascade');
            $table->longText('task_description');
            $table->text('prompt')->nullable();
            $table->timestamp('claim_time')->nullable();
            $table->string('response_1')->nullable();
            $table->string('response_2')->nullable();
            $table->foreignId('settings_id')->constrained('settings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};