<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFtAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ft_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acc_kacab',20)->nullable()->default('tidak');
            $table->string('komentar_kacab',50)->nullable()->default('-');
            $table->string('acc_direktur',20)->nullable()->default('tidak');
            $table->string('komentar_direktur',50)->nullable()->default('-');
            $table->string('acc_manager',20)->nullable()->default('tidak');
            $table->string('komentar_manager',50)->nullable()->default('-');
            $table->string('status_laporan',50)->default('on_create');
            // $table->date('created');
            // $table->date('expired');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('expired_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ft_admin');
        
    }
}
