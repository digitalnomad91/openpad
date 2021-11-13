<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdColumnToNotepads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::drop('notepads');
            

        Schema::create('notepads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_user_id');
            $table->string('name', 100);
            $table->timestamp('created_at');
            $table->text('description');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
