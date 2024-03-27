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
        Schema::table('tasks', function (Blueprint $table) {
            $table->renameColumn('firstname', 'task_name');
            $table->renameColumn('lastname', 'task_description');
            $table->renameColumn('email', 'task_deadline');
            $table->renameColumn('phone', 'task_priority');

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            
            $table->renameColumn('task_name', 'firstname');
            $table->renameColumn('task_description', 'lastname');
            $table->renameColumn('task_deadline', 'email');
            $table->renameColumn('task_priority', 'phone');

        });
    }
};
