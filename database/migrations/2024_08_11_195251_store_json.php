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
        Schema::table('medical_records', function (Blueprint $table) {
            $table->jsonb('xray')->change();
            $table->jsonb('ultrasound')->change();
            $table->jsonb('ct_scan')->change();
            $table->jsonb('mri')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->dropColumn('xray');
            $table->dropColumn('ultrasound');
            $table->dropColumn('ct_scan');
            $table->dropColumn('mri');
        });
    }
};
