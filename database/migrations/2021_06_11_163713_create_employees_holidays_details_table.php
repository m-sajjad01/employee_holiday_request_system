<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesHolidaysDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_holidays_details', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->date('requested_from');
            $table->date('requested_upto');
            $table->string('no_of_days');
            $table->integer('limit')->default(25);;
            $table->tinyInteger('approved');
            $table->tinyInteger('request_sent');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_holidays_details');
    }
}
