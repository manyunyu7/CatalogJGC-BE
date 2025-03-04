<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLengthAndWidthToProductDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->decimal('land_length', 8, 2)->nullable()->after('map_embed_code'); // Ganti 'some_column' dengan kolom sebelumnya
            $table->decimal('land_width', 8, 2)->nullable()->after('land_length');
            $table->decimal('building_length', 8, 2)->nullable()->after('land_width');
            $table->decimal('building_width', 8, 2)->nullable()->after('building_length');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropColumn(['land_length', 'land_width', 'building_length', 'building_width']);
        });
    }
}
