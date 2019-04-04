<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('farmer_info_id');
            $table->unsignedBigInteger('verification_officer_id')->nullable();
            $table->mediumText('address');
            $table->string('size_area');
            $table->string('gps_address')->nullable();
            $table->string('region');
            $table->string('district');
            $table->string('locality');
//            $table->json('applicable_tenure_codes'); //TODO:// Refactor into a table
            $table->boolean('is_tenureship_verified')->default(false);
            $table->boolean('are_documents_verified')->default(false);
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('lands');
    }
}
