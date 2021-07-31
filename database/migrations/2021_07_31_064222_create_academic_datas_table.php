<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_datas', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year',20);
            $table->enum('semester',["Genap","Ganjil","Pendek"]);
            $table->timestamps();
        });

        Schema::table('krs_consultations', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_id')->index();
            $table->foreign('academic_id')->references('id')->on('academic_datas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('krs_consultations', function(Blueprint $table){
            $table->dropForeign(['academic_id']);            
        });

        Schema::dropIfExists('academic_datas');
    }
}
