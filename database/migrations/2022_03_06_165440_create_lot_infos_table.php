<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_infos', function (Blueprint $table) {
            $table->id();
            $table->string('qty_type', 10);
            $table->decimal('qty', 10, 3);
            $table->date('exp');
            $table->date('mfd');
            $table->decimal('cost', 10, 2);
            $table->decimal('s_price', 10, 2);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on("products")->onDelete('cascade');
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
        Schema::dropIfExists('lot_infos');
    }
};
