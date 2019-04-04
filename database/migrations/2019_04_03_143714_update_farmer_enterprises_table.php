<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFarmerEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farmer_enterprises', function (Blueprint $table) {
            $table->bigInteger('farmer_info_id')->unsigned();
            $table->foreign('farmer_info_id')->references('id')->on('farmer_info')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farmer_enterprises', function (Blueprint $table) {
            $table->dropForeign('farmer_enterprises_farmer_info_id_foreign');
        });
    }
}
