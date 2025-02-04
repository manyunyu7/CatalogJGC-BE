<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->string("parent_id")->nullable();
            $table->string("prefix")->nullable();
            $table->decimal("price", 15, 3)->nullable();

            $table->unsignedBigInteger('created_by')->nullable(); // Add created_by column
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Assuming 'users' table exists

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
        Schema::dropIfExists('product_prices');
    }
}
