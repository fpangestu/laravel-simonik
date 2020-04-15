<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_kegiatans', function (Blueprint $table) {
            $table->string('kode_dokumen_kegiatan');
            $table->string('kode_agenda');
            $table->string('kode_dokumen');
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps(); 

            $table->primary('kode_dokumen_kegiatan');
            $table->foreign('kode_agenda')->references('kode_agenda')->on('agenda_kegiatans');
            $table->foreign('kode_dokumen')->references('kode_dokumen')->on('dokumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_kegiatans');
    }
}
