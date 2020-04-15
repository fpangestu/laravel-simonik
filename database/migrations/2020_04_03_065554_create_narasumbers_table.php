<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarasumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('narasumbers', function (Blueprint $table) {
            $table->bigIncrements('kode_narasumber');
            $table->string('nama');
            $table->string('afiliasi');
            $table->string('okupasi');
            $table->string('no_tlp');
            $table->string('email');
            $table->datetime('deleted_at')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('narasumbers');
    }
}
