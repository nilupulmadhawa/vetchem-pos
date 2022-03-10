<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 70);
            $table->string('code', 50)->unique();
            $table->string('qty_type', 10);
            $table->decimal('re_order_level', 10, 3);
            $table->decimal('re_order_qty', 10, 3);
            $table->string('description', 200)->nullable();
            $table->string('status', 10)->default('Active');
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->foreignIdFor(SubCategory::class)->constrained('sub_categories');
            $table->foreignIdFor(Brand::class)->constrained('brands');
            $table->foreignIdFor(Supplier::class)->constrained('suppliers');
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
        Schema::dropIfExists('products');
    }
};
