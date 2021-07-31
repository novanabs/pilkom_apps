<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_user', function (Blueprint $table) {

            $table->string('user_id',30)->index();
            $table->unsignedBigInteger('meeting_id')->index();

            // $table->foreign('user_id')->references('nip')->on('users')->onDelete('cascade');
            // $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
                
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
        // Schema::table('meeting_user', function(Blueprint $table){
        //     $table->dropForeign(['user_id']);
        //     $table->dropForeign(['meeting_id']);
            
        // });
        Schema::dropIfExists('meeting_user');
    }
}