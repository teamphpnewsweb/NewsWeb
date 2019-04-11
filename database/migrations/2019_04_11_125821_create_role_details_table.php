<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('Name');
            $table->unsignedBigInteger('roleId');
            $table->timestamps();

            $table->foreign('roleId')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_details');
    }
}
