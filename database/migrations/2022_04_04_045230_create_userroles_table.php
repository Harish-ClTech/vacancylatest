<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userroles', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('roleid');
            $table->enum('status', ['Y', 'C','R'])->default('Y');
            $table->integer('createdby')->nullable();
            $table->timestamp('createdatetime');
            $table->integer('updatedby')->nullable();
            $table->timestamp('updatedatetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userroles');
    }
}
