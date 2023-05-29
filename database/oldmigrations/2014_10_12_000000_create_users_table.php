<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('email')->unique();
            $table->string('password');
            $table->string('otp')->nullable();
            $table->string('personalid')->nullable();
            $table->enum('status', ['Y', 'R', 'C'])->default('Y');
            $table->integer('createdby')->nullable();
            $table->enum('isVerified',[1,0])->default(0);
            $table->string('verifyToken')->nullable();
            $table->timestamp('createdatetime')->nullable();
            $table->integer('updatedby')->nullable();
            $table->timestamp('updatedatetime')->nullable();
            $table->bigInteger('passwordchangecount')->nullable();

        });
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
}
