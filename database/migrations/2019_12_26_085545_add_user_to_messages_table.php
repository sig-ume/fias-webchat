<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('user')->default('名無し');  //カラム追加
            $table->string('message_id')->default('00000000');  //カラム追加
	    $table->string('room_id')->default('0000');  //カラム追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('user');  //カラム削除
            $table->dropColumn('message_id');  //カラム削除
	    $table->dropColumn('room_id');  //カラム削除
        });
    }
}
