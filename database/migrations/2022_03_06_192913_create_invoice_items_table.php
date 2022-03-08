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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('name', 100);
            $table->string('code', 50);
            $table->decimal('price', 10, 2);
            $table->decimal('qty', 10, 3);
            $table->decimal('discount', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->unsignedBigInteger('lot_info_id');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on("invoices")->onDelete('cascade');
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
        Schema::dropIfExists('invoice_items');
    }
};
