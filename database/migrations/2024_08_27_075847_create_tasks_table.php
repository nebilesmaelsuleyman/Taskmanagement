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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('taskCreator_id')->nullable()->comment('The ID of the user who created the task');
            $table->unsignedBigInteger('assigneduser_id')->nullable()->comment('The ID of the user who created the task');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->foreign('taskCreator_id')->references("id")->on('users')->onDelete('cascade');
            $table->foreign('assigneduser_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
