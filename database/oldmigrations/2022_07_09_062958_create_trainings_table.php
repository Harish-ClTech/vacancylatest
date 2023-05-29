<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->integer('personalid');
            $table->integer('userid');
            $table->string('trainingproviderinstitutionalname')->nullable();
            $table->string('trainingname')->nullable();
            $table->string('gradedivisionpercent')->nullable();
            $table->string('fromdatebs')->nullable();
            $table->string('enddatebs')->nullable();
            $table->string('fromdatead')->nullable();
            $table->string('enddatead')->nullable();
            $table->string('document')->nullable();
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->integer('postedby')->nullable();
            $table->timestamp('posteddatetime')->nullable();
            $table->integer('lastmodifiedby')->nullable();
            $table->timestamp('lastmodifieddatetime')->nullable();
            $table->text('ipaddress')->nullable();
            $table->text('devices')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
