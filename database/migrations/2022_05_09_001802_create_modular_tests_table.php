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
        Schema::create('modular_tests', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('CID');
            $table->string('MID');
            $table->date('FromDate');
            $table->integer('DurationInMinutes')->default(60000);
            // $table->integer('DurationInMinutes')->default(60000);
            $table->string('converted')->default('false');
            $table->string('status')->default('false');
            $table->date('ToDate');
            $table->string('TestBriefDescription');
            $table->longText('TestQuestion');
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
        Schema::dropIfExists('modular_tests');
    }
};