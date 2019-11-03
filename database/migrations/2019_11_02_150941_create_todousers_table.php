<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodousersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todousers', function (Blueprint $table) {
            $table->bigIncrements('u_id');;
            $table->string('u_username', 100);
            $table->string('u_password');
            $table->tinyInteger('u_role');
            $table->string('u_email', 100);
            $table->tinyInteger('u_status');
            $table->string('u_image');
            $table->string('u_thumbnail');
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
        Schema::dropIfExists('todousers');
    }
}
