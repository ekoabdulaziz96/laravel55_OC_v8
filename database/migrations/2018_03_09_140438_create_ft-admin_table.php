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
            $table->string('acc_kacab',20)->nullable()->default('baru');
            $table->string('komentar_kacab',999)->nullable()->default('-');
            $table->boolean('send_kacab')->nullable()->default(false);
            $table->string('acc_manager',20)->nullable()->default('baru');
            $table->string('komentar_manager',999)->nullable()->default('-');
            $table->boolean('send_manager')->nullable()->default(false);
            $table->string('acc_direktur',20)->nullable()->default('baru');
            $table->string('komentar_direktur',999)->nullable()->default('-');
            $table->boolean('send_direktur')->nullable()->default(false);

            $table->string('status_laporan',50)->default('baru');
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
