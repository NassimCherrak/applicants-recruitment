<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant__details', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->integer('id_contact')->unsigned();
            $table->foreign('id_contact')->references('id_contact')->on('applicant__contacts');
            $table->date('date');
            $table->enum('status', ['New','No Show','Not Hired','Hired','Employed','Not Employed','On Hold']);
            $table->enum('program_status', ['Not Started','Ongoing','Program Completed','Program Not Completed'])->nullable($value = true);;
            $table->string('resume_location', 255);
            $table->string('updated_resume', 255);
            $table->integer('id_employer');
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
        Schema::dropIfExists('applicant__details');
    }
}
