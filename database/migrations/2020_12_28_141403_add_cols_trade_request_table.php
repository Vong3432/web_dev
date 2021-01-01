<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsTradeRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_requests', function (Blueprint $table) {
            //
            $table->enum("status", ["PENDING", "REJECTED", "WAITING REFUNDED PRODUCT", "REFUNDED"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_requests', function (Blueprint $table) {
            //
        });
    }
}
