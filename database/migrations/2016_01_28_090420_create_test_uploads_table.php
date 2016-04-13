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
            $table->increments('id');
            $table->string('file_test');
            $table->string('name_test');
            $table->integer('user_id')->index();
            $table->integer('task_id')->index();
            $table->string('disabled')->default('no');
            $table->timestamps();
            $table->string('ip');
            $table->string('countryCode');
            $table->string('countryName');
            $table->string('cityName');
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
