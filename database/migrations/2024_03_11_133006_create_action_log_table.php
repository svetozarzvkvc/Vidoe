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
        Schema::create('action_log', function (Blueprint $table) {
            $table->id();
            $table->string("ip");
            $table->string("path");
            $table->string("method");
            $table->foreignId("user_id")->nullable()->default(null)->index();
            $table->string("action");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_log');
    }
};
