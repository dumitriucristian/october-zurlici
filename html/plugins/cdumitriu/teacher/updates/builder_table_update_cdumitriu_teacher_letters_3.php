<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherLetters3 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_letters', function($table)
        {
            $table->string('email', 100)->nullable();
            $table->boolean('newsletter')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_letters', function($table)
        {
            $table->dropColumn('email');
            $table->dropColumn('newsletter');
        });
    }
}
