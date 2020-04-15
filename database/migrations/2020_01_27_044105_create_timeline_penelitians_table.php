<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelinePenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_penelitians', function (Blueprint $table) {
            $table->integer('kode_timeline');
            $table->integer('kode_penelitian');
            $table->string('nama_timeline'); 
            $table->datetime('tgl_mulai'); 
            $table->datetime('tgl_selesai'); 
            $table->boolean('status')->default(false); 
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps();

            $table->primary('kode_timeline');
            $table->foreign('kode_penelitian')->references('kode_penelitian')->on('penelitians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timeline_penelitians');
    }
}
