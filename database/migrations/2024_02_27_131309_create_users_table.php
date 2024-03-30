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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("username")->unique();
            $table->string("email")->unique();
            $table->string("avatar")->default('defaultavatar.jpg')->nullable();
            $table->string("password");
            $table->string("total_subscribers")->default(0);
            $table->foreignId("role_id")->constrained();
            $table->foreignId("country_id")->constrained();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
