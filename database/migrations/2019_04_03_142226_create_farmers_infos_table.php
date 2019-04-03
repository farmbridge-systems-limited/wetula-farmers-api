<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_infos', function (Blueprint $table) {
            $table->bigIncrements('id'); // Table ID for FarmersApi Service
            $table->unsignedInteger('user_id')->unique(); // Primary User Identifier from Api Gateway
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('nickname')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->date('date_of_birth');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('town_village_settlement');
            $table->mediumText('road_street_trace_address');
            $table->string('house_number');
            $table->string('email')->unique();
            $table->string('postal_office_box');
            $table->string('postal_town_village_settlement');
            $table->string('postal_street_road_trace_sentence');
            $table->string('district_province');
            $table->string('region');
            $table->string('country');
            $table->boolean('is_absentee_farmer');
            $table->boolean('is_verified')->default(false);
            $table->date('date_verified')->nullable();
            $table->string('photograph_url')->default('');
            $table->string('applicant_signage_url')->default('');
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
        Schema::dropIfExists('farmer_info');
    }
}
