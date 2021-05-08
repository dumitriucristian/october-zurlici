<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherDetails6 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            if(!Schema::hasColumn('cdumitriu_teacher_details','year')) {
                $table->integer('year')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->dropColumn('year');
        });
    }
}
