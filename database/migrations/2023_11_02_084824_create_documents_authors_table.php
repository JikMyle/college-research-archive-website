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
        Schema::create('documents_authors', function (Blueprint $table) {
            $table->foreignID('document_id')->constrained()->cascadeOnDelete();
            $table->foreignID('author_id')->constrained()->cascadeOnDelete();
            $table->index(['document_id', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_authors');
    }
};
