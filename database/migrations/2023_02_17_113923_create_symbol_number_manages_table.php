<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymbolNumberManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_number_manages', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('designationid');
            $table->integer('symbolnumber');
            $table->integer('examcenterid');
            $table->string('examcentername');
            $table->enum('status', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('symbol_number_manages');
    }
}
