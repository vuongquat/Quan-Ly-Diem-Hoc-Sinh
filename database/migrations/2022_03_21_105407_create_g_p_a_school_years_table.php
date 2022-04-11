<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGPASchoolYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_p_a_school_years', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student');
            $table->integer('id_school_year');
            $table->integer('id_grade');
            $table->float('gpa_semester_1')->nullable();
            $table->float('gpa_semester_2')->nullable();
            $table->float('gpa_school_year')->nullable();
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
        Schema::dropIfExists('g_p_a_school_years');
    }
}
