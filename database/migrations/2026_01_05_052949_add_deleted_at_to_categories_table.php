<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes(); // यह deleted_at column add करेगा
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes(); // यह deleted_at column remove करेगा
        });
    }
};