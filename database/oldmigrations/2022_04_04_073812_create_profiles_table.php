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
            $table->id();
            $table->integer('userid');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('image')->nullable();
            $table->enum('gender', ['Male', 'Female','Others']);
            $table->string('email')->nullable();
            $table->string('contactnumber')->nullable();
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->integer('createdby')->nullable();
            $table->timestamp('createdatetime');
            $table->integer('updatedby')->nullable();
            $table->timestamp('updatedatetime')->nullable();
            
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

