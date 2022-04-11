<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGPASubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
  * @return void
     */
    public function up()
    {
        Schema::create('g_p_a_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student');
            $table->integer('id_school_year');
            $table->integer('id_semester');
            $table->integer('id_grade');
            $table->float('gpa_math');
            $table->float('gpa_literature');
            $table->float('gpa_english');
            $table->float('gpa_physics');
            $table->float('gpa_chemistry');
            $table->float('gpa_biology');
            $table->float('gpa_history');
            $table->float('gpa_geography');
            $table->float('gpa_technology');
            $table->float('gpa_informatics');
            $table->float('gpa_civic_education');
            $table->float('gpa_national_defense_education');
            $table->string('gpa_physical_education');
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
        Schema::dropIfExists('g_p_a_subjects');
    }
}
