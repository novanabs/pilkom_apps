<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignPhase2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('job_title_id')->references('id')->on('job_titles')->onDelete('cascade');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('job_title_id')->references('id')->on('job_titles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign(['job_title_id']);
        });
        Schema::table('permissions', function(Blueprint $table){
            $table->dropForeign(['job_title_id']);
        });
    }
}