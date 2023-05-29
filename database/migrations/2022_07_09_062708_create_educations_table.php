<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->integer('personalid');
            $table->integer('userid');
            $table->string('universityboardname')->nullable();
            $table->integer('educationlevel')->nullable();
            $table->string('educationfaculty')->nullable();
            $table->string('educationinstitution')->nullable();
            $table->string('devisiongradepercentage')->nullable();
            $table->text('mejorsubject')->nullable();
            $table->text('qulificationawardeddetails')->nullable();
            $table->string('passoutdatead')->nullable();
            $table->string('passoutdatebs')->nullable();
            $table->enum('educationaltype', ['Private', 'Government','Other']);
            $table->string('academicdocument')->nullable();
            $table->string('equivalentdocument')->nullable();
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
        Schema::dropIfExists('educations');
    }
}
