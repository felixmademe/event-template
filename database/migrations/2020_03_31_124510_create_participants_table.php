<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string( 'name' )->nullable();
            $table->string( 'email' );
            $table->string( 'phone' );
            $table->date( 'birth_date' )->default( '2018-12-21' );
            $table->unsignedBigInteger( 'event_id' );
            $table->boolean( 'paid' )->default( false );
            $table->boolean( 'checked' )->default( false );
            $table->timestamp( 'checked_when' )->nullable();
            $table->string( 'slug' );
            $table->timestamps();
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
