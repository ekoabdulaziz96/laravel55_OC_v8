<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('status', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('nama',50);
        //     $table->string('kategori',50);

        //     // $table->integer('kategori_id')->unsigned();
        //     //  $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
