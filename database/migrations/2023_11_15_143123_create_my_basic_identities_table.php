<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyBasicIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_basic_identities', function (Blueprint $table) {
            $table->id();
            $table->string("company_title")->nullable();
            $table->string("company_motto")->nullable();
            $table->string("main_email")->nullable();
            $table->string("main_address")->nullable();
            $table->string("office_hour")->nullable();
            $table->string("contact")->nullable();
            $table->text("description")->nullable();
            $table->text("vision")->nullable();
            $table->text("mission")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * php artisan migrate:rollback --path=/database/migrations/2023_11_15_143123_create_my_basic_identities_table.php
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_basic_identities');
    }
}
