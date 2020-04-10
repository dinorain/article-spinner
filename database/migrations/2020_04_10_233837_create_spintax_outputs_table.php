<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpintaxOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spintax_outputs', function (Blueprint $table) {
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->increments('id');
            $table->string('spintax')->index();
            $table->unsignedInteger('target_id')->index();
            $table->foreign('target_id')->references('id')->on('spintax_inputs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spintax_outputs');
    }
}
