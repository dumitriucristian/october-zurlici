<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherDetails7 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->string('teacher_details', 1000)->change();
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->string('teacher_details', 500)->change();
        });
    }
}
