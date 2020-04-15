<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenIsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_isis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_dokumen_kegiatan');
            $table->integer('kode_kegiatan');
            $table->string('kebutuhan');
            $table->string('tanggung_jawab');
            $table->string('uploader');
            $table->string('etc');
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps();

            $table->foreign('kode_dokumen_kegiatan')->references('kode_dokumen_kegiatan')->on('dokumen_kegiatans');
            $table->foreign('kode_kegiatan')->references('kode_kegiatan')->on('kegiatan_penelitians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_isis');
    }
}
