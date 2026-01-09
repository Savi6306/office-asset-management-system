<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First, check if status column exists
        if (Schema::hasColumn('assignments', 'status')) {
            // Update existing NULL values to 'active'
            DB::table('assignments')->whereNull('status')->update(['status' => 'active']);
            
            // Update existing assignments with empty status
            DB::table('assignments')->where('status', '')->update(['status' => 'active']);
            
            // Set default value for the column
            Schema::table('assignments', function (Blueprint $table) {
                $table->enum('status', ['active', 'returned', 'cancelled'])
                      ->default('active')
                      ->change();
            });
        }
    }

    public function down()
    {
        // Revert if needed
        Schema::table('assignments', function (Blueprint $table) {
            $table->enum('status', ['active', 'returned', 'cancelled'])
                  ->default(null)
                  ->change();
        });
    }
};