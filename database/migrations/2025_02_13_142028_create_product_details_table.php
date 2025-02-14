<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->text('parent_id')->nullable();
            $table->string('floor')->nullable();
            $table->string('electricity')->nullable();
            $table->text('description')->nullable(); // Description of the facility
            $table->unsignedBigInteger('created_by')->nullable(); // Add created_by column
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Assuming 'users' table exists
            $table->unsignedBigInteger('updated_by')->nullable(); // Add created_by column
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null'); // Assuming 'users' table exists
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
        Schema::dropIfExists('product_details');
    }
}
