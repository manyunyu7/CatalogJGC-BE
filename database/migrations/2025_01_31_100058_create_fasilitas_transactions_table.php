<?php

// database/migrations/2023_10_10_create_fasilitas_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('fasilitas_transactions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->text('parent_id')->nullable(); // Plain column, not a foreign key
            $table->unsignedBigInteger('fasilitas_id'); // Foreign key to fasilitas table
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint for icon_id
            $table->foreign('fasilitas_id')->references('id')->on('fasilitas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fasilitas_transactions');
    }
}
