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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string("title")->index();
            $table->string("src");
            $table->decimal("duration",10,2 );
            $table->string("description")->nullable();
            $table->string("thumbnail");
            $table->bigInteger("size")->nullable();
            $table->integer("total_views")->default(0);
            $table->integer("total_likes")->default(0);
            $table->integer("total_dislikes")->default(0);

            $table->foreignId("user_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
