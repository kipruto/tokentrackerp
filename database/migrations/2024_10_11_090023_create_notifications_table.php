<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('from'); // Who sent the notification
            $table->timestamp('time')->default(DB::raw('CURRENT_TIMESTAMP')); // Time the notification was sent
            $table->unsignedBigInteger('to_userid'); // User ID to whom the notification is sent
            $table->string('title'); // Notification title
            $table->text('message'); // Notification message
            $table->decimal('budget_allocated'); // Notification message
            $table->unsignedBigInteger('task_id')->nullable(); // Associated task (optional)
            $table->unsignedBigInteger('workspace_id')->nullable(); // Associated workspace (optional)
            $table->string('links')->nullable(); // Additional link for settings or password reset
            $table->boolean('is_read')->default(false); // Whether the notification is read
            $table->timestamps(); // created_at and updated_at fields

            // Foreign key constraint for `to_userid` referring to the `users` table
            $table->foreign('to_userid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
