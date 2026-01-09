<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('assignments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('asset_id')->constrained()->onDelete('cascade');
        $table->foreignId('employee_id')->constrained()->onDelete('cascade');
        $table->date('assigned_date');
        $table->date('return_date')->nullable();
        $table->enum('status', ['active', 'returned', 'cancelled'])->default('active');
        $table->text('notes')->nullable();
        $table->timestamps();
        
        // Add unique constraint to prevent duplicate active assignments
        $table->unique(['asset_id', 'employee_id', 'assigned_date']);
    });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};