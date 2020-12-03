<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToSubscribeMailListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribe_mail_list', function (Blueprint $table) {
            $table->foreignId("mail_id")->references('id')->on('mails');            
            $table->foreignId("user_id")->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribe_mail_list', function (Blueprint $table) {
            //
        });
    }
}
