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
        Schema::create('log_management', function (Blueprint $table) {
            $table->id();
            $table->binary('ip');
            $table->binary('url');
            $table->string('log');
            $table->binary('data_id')->nullable();
            $table->binary('file_name')->nullable();
            $table->binary('file_path')->nullable();
            $table->binary('latitude');
            $table->binary('longitude');
            $table->binary('user_input');
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
        Schema::dropIfExists('log_management');
    }
};
