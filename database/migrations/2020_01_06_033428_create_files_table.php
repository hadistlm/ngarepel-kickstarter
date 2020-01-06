<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('no');
            $table->string('id_file', 10);
            $table->string('nama_file', 50);
            $table->string('nama_file_asli', 255);
            $table->string('lokasi_file', 255);
            $table->string('tipe_file', 50);
            $table->integer('ukuran_file');
            $table->integer('uploaded_by');
            $table->ipAddress('uploaded_ip');
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
        Schema::dropIfExists('files');
    }
}
