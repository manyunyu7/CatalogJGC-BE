<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconAndSecondLinkColumnToOurBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_sliders', function (Blueprint $table) {
            $table->string("icon")->nullable();
            $table->string("second_action")->nullable();
            $table->string("second_action_link")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_sliders', function (Blueprint $table) {
            $table->dropColumn('icon');
            $table->dropColumn('second_action');
            $table->dropColumn('second_action_link');
        });
    }
}
