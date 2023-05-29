<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefrenceidAndPurchasedatetimeToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('designationid');
            $table->string('referenceid')->nullable();
            $table->string('purchasedatetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('designationid');
            $table->dropColumn('referenceid')->nullable();
            $table->dropColumn('purchasedatetime')->nullable();
        });
    }
}
