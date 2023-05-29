
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('personalid');
            $table->integer('userid');
            $table->string('photography')->nullable();
            $table->string('citizenshipfront')->nullable();
            $table->string('citizenshipback')->nullable();
            $table->string('inclusiongroupcertificateadibashi')->nullable();
            $table->string('inclusiongroupcertificatejanajati')->nullable();
            $table->string('inclusiongroupcertificatedalit')->nullable();
            $table->string('inclusiongroupcertificatepixadiyeko')->nullable();
            $table->string('inclusiongroupcertificatemadesi')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
