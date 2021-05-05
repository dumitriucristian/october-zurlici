<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuRenameColumn extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->renameColumn('county', 'teacher_county');
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
