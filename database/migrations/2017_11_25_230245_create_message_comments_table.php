<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('评论人id');
            $table->integer('message_id')->comment('留言id');
            $table->text('content')->comment('回复留言');
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
        Schema::dropIfExists('message_comments');
    }
}
