<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignatureSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signature_setups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fiscalyearid');
            $table->string('fullname');
            $table->string('designation');
            $table->string('signaturedate');
            $table->string('signature');
            $table->enum('status', ['Y', 'N', 'R'])->default('Y');
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
        Schema::dropIfExists('signature_setups');
    }
}
