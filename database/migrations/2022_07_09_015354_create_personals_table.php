<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->unique();
            $table->string('nfirstname')->nullable();
            $table->string('nmiddlename')->nullable();
            $table->string('nlastname')->nullable();
            $table->string('efirstname')->nullable();
            $table->string('emiddlename')->nullable();
            $table->string('elastname')->nullable();
            $table->string('dateofbirthbs')->nullable();
            $table->string('dateofbirthad')->nullable();
            $table->enum('gender', ['Male', 'Female','Other']);
            $table->string('fatherfirstname')->nullable();
            $table->string('fathermiddlename')->nullable();
            $table->string('fatherlastname')->nullable();
            $table->string('fathercitizen')->nullable();
            $table->string('motherfirstname')->nullable();
            $table->string('mothermiddlename')->nullable();
            $table->string('motherlastname')->nullable();
            $table->string('mothercitizen')->nullable();
            $table->string('grandfatherfirstname')->nullable();
            $table->string('grandfathermiddlename')->nullable();
            $table->string('grandfatherlastname')->nullable();
            $table->string('grandfathercitizen')->nullable();
            $table->string('citizenshipnumber')->nullable();
            $table->integer('citizenshipissuedistrictid')->nullable();
            $table->string('citizenshipissuedate')->nullable();
            $table->string('kskemployee')->nullable();
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->text('ipaddress')->nullable();
            $table->text('devices')->nullable();
            $table->integer('postedby')->nullable();
            $table->timestamp('posteddatetime')->nullable();
            $table->integer('lastmodifiedby')->nullable();
            $table->timestamp('lastmodifieddatetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personals');
    }
}
