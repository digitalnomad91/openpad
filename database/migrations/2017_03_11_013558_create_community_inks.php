<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityInks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->length(64);
            $table->integer("link_id")->length(64);
            $table->integer("community_id")->length(64);
            $table->integer("views")->length(64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_links');
    }
}
