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
        
            // Rename a column
            $table->renameColumn('firstname', 'taskname');
            $table->renameColumn('lastname', 'taskdescription');
            $table->renameColumn('email', 'taskdeadline');
            $table->renameColumn('phone', 'taskpriority');
            $table->renameColumn('image', 'status');
            // Drop a column
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Reverse the modifications made in the "up" method
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('image');
            
        });
    }
};
