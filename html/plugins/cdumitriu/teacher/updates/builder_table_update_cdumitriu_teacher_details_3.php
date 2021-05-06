<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherDetails3 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->string('teacher_details', 500)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->text('teacher_details')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
