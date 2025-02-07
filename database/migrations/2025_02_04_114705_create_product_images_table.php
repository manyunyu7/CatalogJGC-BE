<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id'); // Not a foreign key, as requested
            $table->unsignedBigInteger('created_by')->nullable(); // If nullable, use this
            $table->text('image_path'); // Store the image file path
            $table->text('type')->nullable(); // Store the image type, limited to 50 chars
            $table->text('description')->nullable(); // Store image description
            $table->integer('position')->default(0); // Position column for ordering
            $table->timestamps();
            $table->softDeletes(); // Enable soft deletes

            // If created_by is meant to be a foreign key, keep this:
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

            // Optional: Create an index for parent_id if frequently queried
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
