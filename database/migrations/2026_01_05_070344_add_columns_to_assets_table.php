<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            if (!Schema::hasColumn('assets', 'purchase_date')) {
                $table->date('purchase_date')->nullable();
            }
            if (!Schema::hasColumn('assets', 'purchase_price')) {
                $table->decimal('purchase_price', 10, 2)->nullable()->after('purchase_date');
            }
            if (!Schema::hasColumn('assets', 'location')) {
                $table->string('location')->nullable()->after('purchase_price');
            }
            if (!Schema::hasColumn('assets', 'warranty_expiry')) {
                $table->date('warranty_expiry')->nullable()->after('location');
            }
            if (!Schema::hasColumn('assets', 'added_by')) {
                $table->foreignId('added_by')->nullable()->constrained('users')->onDelete('set null')->after('warranty_expiry');
            }
        });
    }

    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign(['added_by']);
            $table->dropColumn([
                'purchase_date',
                'purchase_price',
                'location',
                'warranty_expiry',
                'added_by'
            ]);
        });
    }
};