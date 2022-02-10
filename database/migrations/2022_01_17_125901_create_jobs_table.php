<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('job_slug');
            $table->string('job_description', 10000);
            $table->string('job_salary');
            $table->boolean('job_condition')->default(0);
            $table->integer('job_vacancy');
            $table->integer('job_referer')->default(0);
            $table->integer('job_interviewer')->default(0);
            $table->integer('hired')->default(0);
            $table->integer('job_bounty');
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
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
        Schema::dropIfExists('jobs');
    }
}
