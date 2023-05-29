<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('personalid')->unique();
            $table->integer('userid')->unique();
            $table->integer('provinceid')->nullable();
            $table->integer('districtid')->nullable();
            $table->integer('municipalityid')->nullable();
            $table->integer('ward')->nullable();
            $table->string('tole')->nullable();        
            $table->string('marga')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('phonenumber')->nullable();
            $table->integer('tempoprovinceid')->nullable();
            $table->integer('tempodistrictid')->nullable();
            $table->integer('tempomunicipalityid')->nullable();
            $table->integer('tempoward')->nullable();
            $table->string('tempotole')->nullable();        
            $table->string('tempomarga')->nullable();
            $table->string('tempohousenumber')->nullable();
            $table->string('tempophonenumber')->nullable();
            $table->string('mobilenumber')->unique();
            $table->string('email')->unique();
            $table->text('maillingaddress')->nullable();
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
        Schema::dropIfExists('contactdetails');
    }
}
