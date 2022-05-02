<?php

use App\Models\Product;
use App\Models\Supplier;
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
            $table->decimal('initial_qty', 10, 3);
            $table->decimal('qty', 10, 3);
            $table->date('mfd')->nullable();
            $table->date('exp');
            $table->decimal('cost', 10, 2);
            $table->decimal('r_price', 10, 2);
            $table->decimal('ws_price', 10, 2);
            $table->foreignIdFor(Product::class)->constrained('products');
            $table->integer('supplier_invoice_id')->default('0');
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
