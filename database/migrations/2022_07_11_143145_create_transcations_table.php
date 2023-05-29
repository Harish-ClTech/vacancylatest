<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranscationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcations', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('personalid');
            $table->string('vacancynumber')->nullable();
            $table->integer('vacancyid')->nullable();
            $table->string('vacancyname')->nullable();
            $table->string('transactionid')->nullable();
            $table->string('token')->nullable();
            $table->string('_token')->nullable();
            $table->string('amount')->nullable();
            $table->string('paymenttype')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('transcations');
    }
}
