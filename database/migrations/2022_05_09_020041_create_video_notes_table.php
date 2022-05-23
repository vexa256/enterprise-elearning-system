<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_notes', function (Blueprint $table) {
            $table->id();
            $table->string('CID');
            $table->string('uuid');
            $table->string('MID');
            $table->string('NotesTitle');
            $table->string('BriefDescription');
            $table->string('url');
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
        Schema::dropIfExists('video_notes');
    }
};