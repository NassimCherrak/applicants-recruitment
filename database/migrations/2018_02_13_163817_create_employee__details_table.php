<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee__details', function (Blueprint $table) {
            $table->increments('id_employee');
            $table->integer('id_contact')->unsigned();
            $table->foreign('id_contact')->references('id_contact')->on('applicant__contacts');
            $table->date('start_date')->nullable($value = true);
            $table->date('end_date')->nullable($value = true);
            $table->enum('department', ['HR', 'ACT', 'IT'])->nullable($value = true);
            $table->enum('shift', ['AM', 'PM'])->nullable($value = true);
            $table->string('title', 50)->nullable($value = true);
            $table->string('login_name', 50)->nullable($value = true);
            $table->string('departure_reason', 255)->nullable($value = true);
            $table->longText('comment')->nullable($value = true);
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
        Schema::dropIfExists('employee__details');
    }
}
