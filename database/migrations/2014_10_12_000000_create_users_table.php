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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nationality')->nullable();
            $table->string('institution')->nullable();
            $table->text('ApplicationLetter')->nullable();
            $table->string('gender')->nullable();
            $table->string('CourseAppliedFor')->nullable();
            $table->string('ApprovalStatus')->default('false');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('UserID')->nullable();
            $table->string('role')->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //$2y$10$S3BdFA9VtG4IiDb4yQnS8.0juFF6ghmoS4aNZ.1YCZ/e4J5hg9fc.

        \DB::table('users')->insert([
            'name' => 'Ayebare Timothy',
            'email' => 'vexa256@gmail.com',
            'password' => '$2y$10$S3BdFA9VtG4IiDb4yQnS8.0juFF6ghmoS4aNZ.1YCZ/e4J5hg9fc',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};