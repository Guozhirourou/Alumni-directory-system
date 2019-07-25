<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //校友列表
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('创建人id');
            $table->string('name')->default('')->comment('列表名');
            $table->timestamps();
        });
        //列表成员
        Schema::create('friend_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('friend_id')->comment('列表id');
            $table->integer('user_id')->comment('列表成员id');
            $table->string('name')->default('')->comment('备注名');
            $table->timestamps();
        });
        //申请加好友
        Schema::create('apply_friends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('friend_id')->comment('朋友id');
            $table->integer('user_id')->comment('申请人id');
            $table->integer('list_id')->comment('列表id');
            $table->text('message')->comment('申请信息');
            $table->integer('status')->default(0)->comment('0:待审,1:通过,2:拒绝');
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
        Schema::dropIfExists('friends');
        Schema::dropIfExists('friend_users');
        Schema::dropIfExists('apply_friends');
    }
}
