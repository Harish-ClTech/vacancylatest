<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyjobmastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applyjobmasters', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->nullable();
            $table->text('registrationnumber')->nullable();
            $table->text('receipnumber')->nullable();
            $table->string('applieddatebs');
            $table->string('applieddatead');
            $table->enum('appliedstatus', ['Pending', 'Rejected', 'Verified', 'Canceled']);
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
        Schema::dropIfExists('applyjobmasters');
    }
}
