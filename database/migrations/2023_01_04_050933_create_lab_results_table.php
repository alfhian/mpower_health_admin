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
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('biomarker_id')->nullable();
            $table->string('lab_result_no', 50);
            $table->string('lab_result', 100);
            $table->string('file_path', 100);
            $table->string('claim', 1)->nullable();
            $table->string('user_claim', 50)->nullable();
            $table->integer('recommendation_id')->nullable();
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
        Schema::dropIfExists('lab_results');
    }
};
