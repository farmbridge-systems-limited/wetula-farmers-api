<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('land_id');
            $table->enum('document_type', ['lease', 'deed', 'agreement', 'rent receipt', 'affidavit']);
            $table->string('document_url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_documents');
    }
}
