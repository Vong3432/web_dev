<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->text("description");
            // $table->unsignedInteger("category_id")->nullable();
            // $table->foreignId("category_id")->references('id')->on('products_category');            
            $table->integer("stocks")->default(0);
            $table->decimal("price", 8, 2)->default(0);
            $table->text("tags");
            $table->double("discount_rate", 2, 1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
