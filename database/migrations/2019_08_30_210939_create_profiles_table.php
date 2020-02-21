<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('sexe', ['-', 'm', 'f'])->default("-");
            $table->timestamp('birthday')->nullable();;
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('url')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('facebook_username')->nullable();
            $table->string('google_plus_username')->nullable();
            $table->string('pinterest_username')->nullable();
            $table->string('dribbble_username')->nullable();
            $table->string('github_username')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('avatar_status')->default(0);
            $table->string("cover")->nullable();
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
        Schema::dropIfExists('profiles');
    }
}

