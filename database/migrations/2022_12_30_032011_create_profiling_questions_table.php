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
        Schema::create('profiling_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question', 200);
            $table->string('stat', 1)->default('Y');
            $table->string('type', 10);
            $table->integer('position');
            $table->integer('order');
            $table->integer('step');
            $table->integer('next_step');
            $table->integer('prev_step');
            $table->string('gender', 1)->nullable();
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
        Schema::dropIfExists('profiling_questions');
    }
};
