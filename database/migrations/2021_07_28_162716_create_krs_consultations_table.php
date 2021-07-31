<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->index();
            $table->string('user_id',30)->index();
            $table->string('slip_ukt',100)->nullable();
            $table->string('khs',100)->nullable();
            $table->string('transkrip',100)->nullable();
            $table->string('krs_sementara',100)->nullable();
            // $table->enum('status',['BELUM UPLOAD','SUDAH DILIHAT','SEBAGIAN DILIHAT']);
            $table->timestamps();

            $table->foreign('student_id')->references('nim')->on('students')->onDelete('cascade');
            $table->foreign('user_id')->references('nip')->on('users')->onDelete('cascade');
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
            $table->dropForeign(['student_id']);
            $table->dropForeign(['user_id']);
            
        });

        Schema::dropIfExists('krs_consultations');

        
    }
}