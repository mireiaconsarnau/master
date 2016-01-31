<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_uploads', function (Blueprint $table) {
            $table->increments('id_testup');
            $table->string('file_test');
            $table->string('name_test');
            $table->integer('id_user')->index();
            $table->integer('id_task')->index();
            $table->integer('id_trainup')->index();
            $table->string('disabled')->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('test_uploads');
    }
}
