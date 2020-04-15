<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_penelitians', function (Blueprint $table) {
            $table->integer('kode_kegiatan');
            $table->integer('kode_timeline');
            $table->string('kode_agenda');
            $table->string('nama_kegiatan');
            $table->string('tempat')->nullable();
            $table->datetime('tgl_mulai'); 
            $table->datetime('tgl_selesai'); 
            $table->boolean('status')->default(false); 
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps();
            
            $table->primary('kode_kegiatan');
            $table->foreign('kode_timeline')->references('kode_timeline')->on('timeline_penelitians');
            $table->foreign('kode_agenda')->references('kode_agenda')->on('agenda_kegiatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_penelitians');
    }
}
