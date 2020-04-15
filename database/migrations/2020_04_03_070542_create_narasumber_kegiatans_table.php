<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarasumberKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narasumber_kegiatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode_kegiatan');
            $table->bigInteger('kode_narasumber')->unsigned();
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps();

            $table->foreign('kode_kegiatan')->references('kode_kegiatan')->on('kegiatan_penelitians');
            $table->foreign('kode_narasumber')->references('kode_narasumber')->on('narasumbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narasumber_kegiatans');
    }
}
