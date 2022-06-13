<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('retweets', function (Blueprint $table) {
            $table->primary(["user_id", "tweet_id"]);
            $table->foreignId("user_id");
            $table->foreignId("tweet_id");
            $table->timestamps();


            $table->foreign("user_id")->on("users")->references("id")->onDelete("cascade");
            $table->foreign("tweet_id")->on("tweets")->references("id")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('retweets');
    }
};
