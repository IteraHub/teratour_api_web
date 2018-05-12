<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     * username` varchar(255) NOT NULL,
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('about')->nullable();
            $table->string('location')->nullable();
            $table->string('dob')->nullable();
            $table->boolean('gender')->nullable();
            $table->string('image_url')->nullable();
            $table->string('coverphoto_url')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('username');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
