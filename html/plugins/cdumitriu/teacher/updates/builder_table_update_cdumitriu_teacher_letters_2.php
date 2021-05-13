<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherLetters2 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_letters', function($table)
        {
            $table->string('ip', 100);
            $table->string('sursa', 50);
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_letters', function($table)
        {
            $table->dropColumn('ip');
            $table->dropColumn('sursa');
        });
    }
}
