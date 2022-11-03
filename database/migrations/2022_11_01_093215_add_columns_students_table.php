<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->boolean('is_transportation_fee')->default(false);
            $table->boolean('is_tution_fee')->default(false);
            $table->string('pickup_point')->nullable();
            $table->boolean('is_food_fee')->default(false);
            $table->boolean('is_clothing_fee')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('is_transportation_fee');
            $table->dropColumn('pickup_point');
            $table->dropColumn('is_food_fee');
            $table->dropColumn('is_clothing_fee');
        });
    }
}
