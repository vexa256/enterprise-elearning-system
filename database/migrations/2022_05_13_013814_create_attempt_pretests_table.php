<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_pretests', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('CID')->nullable();
            $table->string('PretestID')->nullable();
            $table->string('UserID')->nullable();
            $table->string('status')->default('false');
            $table->string('MarkingStatus')->default('false');
            $table->string('TimerStarted')->default('true');
            $table->longText('PretestQuestion')->nullable();
            $table->longText('UserAnswer')->nullable();
            $table->longText('InstructorComments')->nullable();
            $table->integer('UserScore')->nullable();
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
        Schema::dropIfExists('attempt_pretests');
    }
};