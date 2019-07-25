<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //群
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar')->default('storage/groupavatar/avatar.png');
            $table->string('name')->comment('群名称');
            $table->integer('user_id')->comment('群主id');
            $table->timestamps();
        });
        //群成员
        Schema::create('group_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin')->default(0)->comment('1:管理员');
            $table->integer('group_id')->comment('群id');
            $table->integer('user_id')->comment('群成员id');
            $table->string('name')->default('')->comment('群名片');
            $table->timestamps();
        });
        //申请加群
        Schema::create('apply_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->comment('群id');
            $table->integer('user_id')->comment('申请人id');
            $table->integer('check_id')->default(0)->comment('审核人id');
            $table->integer('status')->default(0)->comment('0:待审,1:通过,2:拒绝');
            $table->text('message')->comment('申请信息');
            $table->timestamps();
        });
        //群公告
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->comment('群id');
            $table->integer('group_user_id')->comment('发公告人id');
            $table->string('title')->comment('公告标题');
            $table->text('message')->comment('公告内容');
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
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_users');
        Schema::dropIfExists('apply_groups');
        Schema::dropIfExists('announcements');
    }
}
