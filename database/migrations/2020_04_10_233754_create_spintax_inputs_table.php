<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpintaxInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spintax_inputs', function (Blueprint $table) {
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->increments('id');
            $table->string('target')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spintax_inputs');
    }
}
