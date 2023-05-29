<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('vacancynumber')->nullable();
            $table->integer('level')->nullable();
            $table->integer('designation')->nullable();
            $table->integer('servicesgroup')->nullable();
            $table->integer('jobcategory')->nullable();
            $table->integer('academicid')->nullable();
            $table->string('vacancyrate')->nullable();
            $table->integer('numberofvacancy')->nullable();
            $table->string('vacancypublishdate')->nullable();
            $table->string('vacancyenddate')->nullable();
            $table->string('extendeddate')->nullable();
            $table->enum('jobstatus', ['Active', 'Inactive'])->default('Active');
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->integer('postedby')->nullable();
            $table->timestamp('posteddatetime')->nullable();
            $table->integer('lastmodifiedby')->nullable();
            $table->timestamp('lastmodifieddatetime')->nullable();
            $table->text('ipaddress')->nullable();
            $table->text('devices')->nullable();
            $table->string('vacancypublishdatead')->nullable();
            $table->string('vacancyenddatead')->nullable();
            $table->string('agelimit')->nullable();
            $table->string('qualification')->nullable();
            $table->string('fiscalyearid')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}

