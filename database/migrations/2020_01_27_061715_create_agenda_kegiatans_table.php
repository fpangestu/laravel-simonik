<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_kegiatans', function (Blueprint $table) {
            $table->string('kode_agenda');
            $table->string('nama_agenda');
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();

            $table->primary('kode_agenda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda_kegiatans');
    }
}
