<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('FullName',50);
            $table->string('Email',50)->unique();
            $table->string('Password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('__admins');
    }
}
