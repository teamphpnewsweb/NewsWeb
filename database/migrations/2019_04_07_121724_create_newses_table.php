<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('CateId')->not_null();
            $table->unsignedBigInteger('AppovedBy')->nullable(true);
            $table->unsignedBigInteger('DeletedBy')->nullable(true);
            $table->unsignedBigInteger('CreateBy');
            $table->string('Title');
            $table->text('Content');
            $table->string('Decription',200);
            $table->string('Image',150);
            $table->dateTime('CreateAt');
            $table->dateTime('DeletedAt')->nullable(true);
            $table->boolean('Approved')->nullable(true);

            $table->foreign('CateId', 'FK_news_category')->references('id')->on('categories');
            $table->foreign('AppovedBy', 'FK_news_admin_appove')->references('id')->on('_admins');
            $table->foreign('DeletedBy', 'FK_news_admin_deleted')->references('id')->on('_admins');
            $table->foreign('CreateBy', 'FK_news_admin_created')->references('id')->on('_admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIndex('FK_news_category');
        // Schema::dropIndex('FK_news_admin_appove');
        // Schema::dropIndex('FK_news_admin_deleted');
        // Schema::dropIndex('FK_news_admin_created');
        Schema::dropIfExists('newses');
    }
}
