<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->integer('kode_penelitian');
            $table->string('judul_penelitian');
            $table->datetime('tgl_mulai');
            $table->datetime('tgl_selesai');
            $table->string('proposal')->nullable();
            $table->string('tor')->nullable();
            $table->string('laporan_akhir')->nullable();
            $table->boolean('status')->default(false); 
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps();

            $table->primary('kode_penelitian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penelitians');
    }
}
