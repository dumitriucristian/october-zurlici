<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherLetters extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_letters', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('file', 100);
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_letters', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('file');
        });
    }
}
