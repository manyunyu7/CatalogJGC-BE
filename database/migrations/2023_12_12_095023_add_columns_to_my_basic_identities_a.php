<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMyBasicIdentitiesA extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_basic_identities', function (Blueprint $table) {
            $table->string("company_title")->nullable();
            $table->string("company_motto")->nullable();
            $table->string("main_email")->nullable();
            $table->string("main_address")->nullable();
            $table->string("office_hour")->nullable();
            $table->string("contact")->nullable();
            $table->text("description")->nullable();
            $table->text("vision")->nullable();
            $table->text("mission")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_basic_identities', function (Blueprint $table) {
            $table->dropColumn('company_title');
            $table->dropColumn('company_motto');
            $table->dropColumn('main_email');
            $table->dropColumn('main_address');
            $table->dropColumn('office_hour');
            $table->dropColumn('contact');
            $table->dropColumn('vision');
            $table->dropColumn('mission');
        });
    }
}
