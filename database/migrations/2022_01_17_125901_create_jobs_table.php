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
            $table->integer('job_bounty');
            $table->boolean('_status')->default(1);
            $table->integer('job_vacancy');
            $table->string('working_hours')->nullable();
            $table->string('joining_date');
            $table->string('expiry_date');
            $table->boolean('_hourly')->default(0);
            $table->string('hourly_rate')->nullable();
            $table->boolean('_remote')->default(0);
            $table->enum('job_type', ['full', 'part', 'any']);
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->string('_timezone');
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
