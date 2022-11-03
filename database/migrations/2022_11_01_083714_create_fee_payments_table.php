<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->double('regular_fee');
            $table->double('tution_fee');
            $table->double('sports_fee')->nullable();
            $table->double('transportation_fee')->nullable();
            $table->double('food_fee')->nullable();
            $table->double('clothing_fee')->nullable();

            $table->double('other_payments')->nullable();
            $table->longText('description')->nullable();

            $table->dateTime('payment_untill');
            $table->dateTime('paid_date');
            $table->string('payment_method');
            $table->longText('payment_description')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_payments');
    }
}
