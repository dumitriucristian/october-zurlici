<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherDetails extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            if(!Schema::hasColumn('cdumitriu_teacher_details','user_surname')) {
                $table->string('user_surname', 191)->nullable();
            }
            
            if(!Schema::hasColumn('cdumitriu_teacher_details','user_surname')) {
                $table->string('teacher_surname', 191)->nullable();
            }
            
            if(!Schema::hasColumn('cdumitriu_teacher_details','user_surname')) {
                $table->string('teacher_county', 191)->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->dropColumn('user_surname');
            $table->dropColumn('teacher_surname');
            $table->dropColumn('teacher_county');
        });
    }
}