<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyDateMastersTable extends Migration
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
            $table->foreignId('fiscalyearid')->constrained('fiscal_years', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('vacancypublishdate')->nullable();
            $table->string('vacancyenddate')->nullable();
            $table->string('vacancyextendeddate')->nullable();
            $table->enum('status', ['Y', 'C','R', 'N'])->default('Y');
            $table->enum('allow_registration', ['Y', 'N'])->default('N');
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
