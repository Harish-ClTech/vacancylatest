<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->integer('personalid');
            $table->integer('userid');
            $table->string('officename')->nullable();
            $table->text('officeaddress')->nullable();
            $table->string('jobtype')->nullable();
            $table->string('designation')->nullable();
            $table->string('service')->nullable();
            $table->string('group')->nullable();
            $table->string('subgroup')->nullable();
            $table->string('ranklabel')->nullable();
            $table->string('fromdatebs')->nullable();
            $table->string('enddatebs')->nullable();
            $table->string('workingstatus')->nullable();
            $table->string('workingstatuslabel')->nullable();
            $table->string('document')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->integer('postedby')->nullable();
            $table->timestamp('posteddatetime')->nullable();
            $table->integer('lastmodifiedby')->nullable();
            $table->timestamp('lastmodifieddatetime')->nullable();
            $table->text('ipaddress')->nullable();
            $table->text('devices')->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
