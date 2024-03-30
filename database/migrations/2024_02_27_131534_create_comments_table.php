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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string("text");
            $table->foreignId("video_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("parent_id")->nullable()->constrained("comments")->cascadeOnDelete();
            $table->integer("total_likes")->default(0);
            $table->integer("total_dislikes")->default(0);

//            $table->unsignedBigInteger("parent_id")->nullable();
//            $table->foreign("parent_id")->references("id")->on("comments")->cascadeOnDelete();
//            $table->foreign("parent_id")->references("id")->on("comments")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
