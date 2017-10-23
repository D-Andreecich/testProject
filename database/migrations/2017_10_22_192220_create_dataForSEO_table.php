<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataForSEOTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataForSEO', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('task_id');
            $table->integer('se_id');
            $table->integer('loc_id');
            $table->integer('key_id');
            $table->string('post_key');
            $table->string('post_site');
            $table->string('result_datetime');
            $table->integer('result_position');
            $table->string('result_url');
            $table->string('result_title');
            $table->string('result_snippet_extra');
            $table->text('result_snippet');
            $table->bigInteger('results_count');
            $table->string('result_extra');
            $table->string('result_spell');
            $table->string('result_se_check_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataForSEO');
    }
}
