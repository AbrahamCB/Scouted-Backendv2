<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referars', function (Blueprint $table) {
            $table->id();
            $table->string('referrer_name');
            $table->string('referrer_email');
            $table->string('_referrerurl');
            $table->string('candidate_name');
            $table->string('candidate_email');
            $table->string('_candidateurl');
            $table->bigInteger('job_id');
            $table->timestamps();
        });

        Schema::create('job_referar', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_id');
            $table->bigInteger('referer_id');
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
        Schema::dropIfExists('referars');
        Schema::dropIfExists('job_referar');
    }
}
