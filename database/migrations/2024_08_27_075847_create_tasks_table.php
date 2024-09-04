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
            $table->unsignedBigInteger('created_by')->nullable()->comment('The Id of user who create the task');
            $table->unsignedBigInteger('assigned_to')->nullable()->comment('The ID of the user assigned to the task');
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade'); 

        });
        Schema::create('task_user', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['task_id', 'user_id']);
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
        
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
