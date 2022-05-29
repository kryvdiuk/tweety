<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->primary(["user_id", "followee_id"]);
            $table->foreignId("user_id");
            $table->foreignId("followee_id");
            $table->timestamps();


            $table->foreign("user_id")->on("users")->references("id")->onDelete("cascade");
            $table->foreign("followee_id")->on("users")->references("id")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
