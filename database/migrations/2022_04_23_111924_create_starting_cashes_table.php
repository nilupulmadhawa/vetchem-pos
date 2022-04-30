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
        Schema::create('starting_cashes', function (Blueprint $table) {
            $table->id();
            $table->decimal('start_of_day', 10, 2);
            $table->decimal('end_of_day', 10, 2)->default('-1');
            $table->string('note', 100);
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
        Schema::dropIfExists('starting_cashes');
    }
};
