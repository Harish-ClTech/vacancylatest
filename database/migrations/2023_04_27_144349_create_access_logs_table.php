<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesslogs', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->enum('sendby', ['Admin', 'User']);
            $table->longText('message');
            $table->enum('logstatus', ['Request', 'Allow', 'Completed', 'Verified']);
            $table->enum('logqueue', ['Pending', 'Completed'])->default('Pending');
            $table->enum('modulename', ['Personal','Others','Contact','Education','Training','Experiences','Document']);
            $table->enum('status', ['Y', 'R'])->default('Y');
            $table->integer('postedby')->nullable();
            $table->timestamp('createddatetime')->nullable();
            $table->integer('lastmodifiedby')->nullable();
            $table->timestamp('lastmodifieddatetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesslogs');
    }
}
