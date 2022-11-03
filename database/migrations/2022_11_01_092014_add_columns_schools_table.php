<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->double('tution_fee')->nullable();
            $table->double('sports_fee')->nullable();
            $table->double('transportation_fee')->nullable();
            $table->double('food_fee')->nullable();
            $table->double('clothing_fee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn('tution_fee');
            $table->dropColumn('sports_fee');
            $table->dropColumn('transportation_fee');
            $table->dropColumn('food_fee');
            $table->dropColumn('clothing_fee');
        });
    }
}
