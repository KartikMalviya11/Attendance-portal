<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->string("apply_date");
            $table->string("leave_type");
            $table->string("reason");
            $table->string("from_date")->nullable();
            $table->string("to_date")->nullable();
            $table->string("no_of_days")->nullable();
            $table->string("leave_status")->default(0);
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
        Schema::dropIfExists('leaves');
    }
}
