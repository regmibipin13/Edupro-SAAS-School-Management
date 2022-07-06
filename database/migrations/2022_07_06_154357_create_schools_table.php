<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->string('city');
            $table->string('address');
            $table->string('google_map_link')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_contact')->unique()->nullable();
            $table->string('principle_name');
            $table->string('principle_contact')->unique()->nullable();
            $table->string('is_active')->default(false);
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
        Schema::dropIfExists('schools');
    }
}
