<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicegroups', function (Blueprint $table) {
            $table->id();
            $table->string('servicegroupname');
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->timestamp('posteddatetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicegroups');
    }
}
