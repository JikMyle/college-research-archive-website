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
        Schema::table('documents', function (Blueprint $table) {
            $table->integer('date_submitted', false, true)->change();
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->renameColumn('date_submitted', 'year_submitted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->date('year_submitted')->change();
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->renameColumn('date_submitted', 'year_submitted');
        });
    }
};
