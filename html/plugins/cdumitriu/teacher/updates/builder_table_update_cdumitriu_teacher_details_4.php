<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherDetails4 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->string('teacher_city', 191)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->dropColumn('teacher_city');
        });
    }
}
