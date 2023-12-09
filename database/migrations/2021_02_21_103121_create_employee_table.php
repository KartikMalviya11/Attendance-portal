<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("company_email")->nullable();
            $table->string("contact");
            $table->string("dob");
            $table->string("address");
            $table->string("joining_date")->nullable();
            $table->string("designation")->nullable();
            $table->string("approve_flag")->default(0);
            $table->string("password")->default("sanjnmdljiijewuoasbnnk");
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
        Schema::dropIfExists('employee');
    }
}
