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
            $table->text("desc");
            $table->decimal("price", 10, 2)->default(0);
            $table->decimal("sprice", 10, 2)->default(0);
            $table->integer("quantity")->default(0);
            $table->double("weight", 2, 1)->default(0);
            $table->integer("status")->default(0);            
            $table->text("tags");
            $table->double("discount_rate", 2, 1)->default(0);
            // $table->unsignedInteger("category_id")->nullable();
            // $table->foreignId("category_id")->references('id')->on('products_category');            
            
            
            
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
