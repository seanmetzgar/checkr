<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckrIntegrationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkr_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned()
                ->default(0);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('candidate_id')->unique();
            $table->timestamp('checkr_created_at')->nullable();
            $table->string('object');
            $table->timestamps();
        });

        Schema::create('checkr_reports', function (Blueprint $table) {
            $table->increments('id');

            // Foreign Key (candidate_id on checkr_candidates)
            $table->string('candidate_id');
            $table->foreign('candidate_id')
                ->references('candidate_id')
                ->on('checkr_candidates')
                ->onDelete('cascade');

            // Report Information
            $table->string('report_id');
            $table->string('object');
            $table->string('status');
            $table->string('package');

            // Other Checkr IDs
            $table->string('ssn_trace_id');
            $table->string('sex_offender_search_id');
            $table->string('national_criminal_search_id');
            $table->string('federal_criminal_search_id');
            $table->mediumText('county_criminal_search_ids');
            $table->string('motor_vehicle_report_id');
            $table->mediumText('state_criminal_search_ids');
            $table->mediumText('document_ids');

            // Report Stats
            $table->timestamp('checkr_created_at')->nullable();
            $table->timestamp('checkr_completed_at')->nullable();
            $table->timestamp('checkr_due_time')->nullable();
            $table->integer('turnaround_time');

            // Eloquent Timestamps
            $table->timestamps();
        });

        Schema::create('checkr_events', function(Blueprint $table) {
            $table->increments('id');

            // Checkr Details
            $table->string('event_id')->unique();
            $table->string('object');
            $table->string('type');

            // Webhook Data Object
            $table->string('checkr_object_id');
            $table->string('checkr_object_type');
            $table->mediumText('data');

            //Webhook Stats
            $table->timestamp('checkr_created_at')->nullable();

            // Eloquent Timestamps
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
        Schema::dropIfExists('checkr_candidates');
        Schema::dropIfExists('checkr_reports');
        Schema::dropIfExists('checkr_events');
    }
}
