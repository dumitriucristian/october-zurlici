<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCdumitriuTeacherLetters extends Migration
{
    public function up()
    {
        Schema::create('cdumitriu_teacher_letters', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('teacher_name', 50);
            $table->string('teacher_surname', 50);
            $table->string('student_name', 50);
            $table->string('student_surname', 50);
            $table->string('apreciation', 100);
            $table->string('letter', 485);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('cdumitriu_teacher_letters');
    }
}
