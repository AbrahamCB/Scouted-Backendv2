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
            $table->boolean('_self')->default(0);
            $table->string('candidate_name')->nullable();
            $table->string('candidate_email')->nullable();
            $table->string('_candidateurl');
            $table->string('referring_description');
            $table->string('person_work');
            $table->string('describe_them');
            $table->string('opportunities');
            $table->string('referring_company');
            $table->string('payment_candidate');
            $table->string('about_us');
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

