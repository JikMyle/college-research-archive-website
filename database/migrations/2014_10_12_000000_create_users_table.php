<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 24)->unique();
            $table->string('email')->unique();
            $table->string('password', 150);
            $table->boolean('is_admin');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->rememberToken()->nullable();
            $table->timestamp('email_verified_at', 0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
