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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('program');
            $table->text('excerpt');
            $table->date('date_submitted');
            $table->string('file_name');
            $table->timestamp('date_uploaded', 0)->nullable();
            $table->timestamp('date_last_updated', 0)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
