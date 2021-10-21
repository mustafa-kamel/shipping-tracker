<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('shipment_number', 10)->unique();
            $table->enum('status', array_keys(config('enums.ship_status_enum')))->default(array_keys(config('enums.ship_status_enum'))[0]);
            $table->string('address');
            $table->unsignedBigInteger('courier_id');
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('CASCADE');
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
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropForeign('shippings_courier_id_foreign');
        });
        Schema::dropIfExists('shippings');
    }
}
