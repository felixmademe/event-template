<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string( 'slug' )->unique();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
            $table->integer('max_visitors')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->string('image_banner')->nullable();
            $table->boolean('public')->default( false );
            $table->boolean('registration')->default( false );
            $table->integer( 'price' )->default( 150 );
            $table->string( 'swish' )->nullable();
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
        Schema::dropIfExists('events');
    }
}
