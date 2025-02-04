<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('icon'); // Stores the icon (e.g., file path or icon class)
            $table->string('name'); // Name of the facility
            $table->text('description')->nullable(); // Description of the facility
            $table->softDeletes(); // Adds the `deleted_at` column


            $table->unsignedBigInteger('created_by')->nullable(); // Add created_by column
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); // Assuming 'users' table exists


            $table->unsignedBigInteger('deleted_by')->nullable(); // Add created_by column
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null'); // Assuming 'users' table exists


            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
}
