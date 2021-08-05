<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MessageLog', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->comment('訊息編號');
            $table->boolean('isCommand')->comment('是否為指令');
            $table->text('message')->comment('訊息');
            $table->integer('chatRoomId')->comment('聊天室編號');
            $table->integer('userId')->comment('使用者編號');
            $table->timestamp('datetime')->comment('時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_log');
    }
}
