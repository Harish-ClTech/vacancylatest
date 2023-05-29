<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtradetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extradetails', function (Blueprint $table) {
            $table->id();
            $table->integer('personalid')->unique();
            $table->integer('userid')->unique();
            $table->string('cast')->nullable();
            $table->string('religion')->nullable();
            $table->string('casteother')->nullable();
            $table->string('religionother')->nullable();
            $table->enum('maritalstatus', ['Married', 'Single','Divorcee']);
            $table->string('spousename')->nullable();
            $table->string('spousecitizen')->nullable();
            $table->enum('employmentstatus', ['Employeed', 'Unemployeed','Others']);
            $table->string('employmetothers')->nullable();
            $table->string('motherlanguage')->nullable();
            $table->string('disabilitystatus')->nullable();
            $table->string('disabilityoverview')->nullable();
            $table->string('fathereducationqulification')->nullable();
            $table->string('mothereducationqulification')->nullable();
            $table->string('fatherandmotheroccupation')->nullable();
            $table->string('fatherandmotheroccupationother')->nullable();
            $table->text('whatyouwantoyourself')->nullable();
            $table->text('whatyouwantoyourselfother')->nullable();
            $table->string('castgroup')->nullable();
            $table->string('other')->nullable();
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
        Schema::dropIfExists('extradetails');
    }
}
