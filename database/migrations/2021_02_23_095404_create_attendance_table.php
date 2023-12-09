<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->string("date");
            $table->string("late_hours");
            $table->string("attendance_status")->default(0);
            $table->string("extra_work")->default(0);
            $table->string("in_time")->nullable();
            $table->string("out_time")->nullable();
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
        Schema::dropIfExists('attendance');
    }
}
