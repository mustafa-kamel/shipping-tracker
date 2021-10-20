<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shipping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shipping_id');
            $table->unsignedSmallInteger('count')->default(1);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('CASCADE');
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
        Schema::table('products_shippings', function (Blueprint $table) {
            $table->dropForeign('product_id');
            $table->dropForeign('shipping_id');
        });
        Schema::dropIfExists('products_shippings');
    }
}
