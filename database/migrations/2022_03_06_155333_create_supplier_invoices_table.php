<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Supplier;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('s_invoice_no', 30)->unique();
            $table->string('note', 100)->nullable();
            $table->decimal('total', 10, 2);
            $table->boolean('is_paid')->default(true);
            $table->date('issue_at')->nullable();
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
        Schema::dropIfExists('supplier_invoices');
    }
};
