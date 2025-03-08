<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('appointments');
    }

    public function down()
    {
        // If you want to recreate the table in a rollback scenario
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('desired_date');
            $table->time('desired_time');
            $table->string('specialty');
            $table->text('comments')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
}
