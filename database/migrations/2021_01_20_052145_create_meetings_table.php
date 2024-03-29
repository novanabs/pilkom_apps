<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->string('notulen_id',30)->index();
            $table->unsignedBigInteger('room_id')->index();
            $table->datetime('meeting_date');
            $table->Integer('duration');
            $table->text('notes');
            $table->timestamps();

            $table->foreign('notulen_id')->references('nip')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meetings', function(Blueprint $table){
            $table->dropForeign(['notulen_id']);
            $table->dropForeign(['room_id']);
        });
        Schema::dropIfExists('meetings');
    }
}