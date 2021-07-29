<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('krs_consultation_id')->index();
            $table->text('comment')->nullable();
            $table->enum('status',['DISETUJUI','BELUM DISETUJUI']);
            $table->timestamps();
            $table->foreign('krs_consultation_id')->references('id')->on('krs_consultations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultation_notes', function(Blueprint $table){
            $table->dropForeign(['krs_consultation_id']);
        });

        Schema::dropIfExists('consultation_notes');
    }
}