<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('train_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_train');
            $table->string('name_train');
            $table->integer('user_id')->index();
            $table->integer('associated_user_id')->default(0);
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
        Schema::drop('train_uploads');
    }
}
