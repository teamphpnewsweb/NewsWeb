<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('_admins', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('roleId');
            $table->foreign('roleId','FK_admin_role')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_admins', function (Blueprint $table) {
            //
            $table->dropForeign('FK_admin_role');
        });
    }
}
