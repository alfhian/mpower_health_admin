<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_information', function (Blueprint $table) {
            $table->string('client_id', 10);
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('verified_status', 1)->default('Y');
            $table->date('birthdate');
            $table->string('phone_code', 6);
            $table->string('phone_number', 13);
            $table->string('street_address', 255);
            $table->string('street_address_2', 255);
            $table->string('city', 50);
            $table->string('state_province', 50)->nullable();
            $table->string('postal_code', 5);
            $table->string('country', 50);
            $table->text('personal_information')->nullable();
            $table->string('user_input', 50)->nullable();
            $table->string('user_update', 50)->nullable();
            $table->string('user_delete', 50)->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('client_information');
    }
};
