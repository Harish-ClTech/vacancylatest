<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyDateMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_date_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fiscalyearid');
            $table->string('vacancypublishdate');
            $table->string('vacancyenddate');
            $table->string('vacancyextendeddate');
            $table->enum('allow_registration', ['Y', 'N'])->default('N');
            $table->enum('status', ['Y', 'N'])->default('Y');
            $table->integer('postedby')->nullable();
            $table->integer('updatedby')->nullable();
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
        Schema::dropIfExists('vacancy_date_masters');
    }
}
