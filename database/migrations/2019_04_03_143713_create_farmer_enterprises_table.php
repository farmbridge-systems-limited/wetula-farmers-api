<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_enterprises', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->bigInteger('farmer_info_id')->unsigned();
            $table->bigInteger('enterprise_id')->unsigned();
            $table->enum('engagement_status', ['major', 'minor']);
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
        Schema::dropIfExists('farmer_enterprises');
    }
}
