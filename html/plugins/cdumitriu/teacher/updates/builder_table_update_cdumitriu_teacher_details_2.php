<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCdumitriuTeacherDetails2 extends Migration
{
    public function up()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->string('source', 50)->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('image', 191)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('cdumitriu_teacher_details', function($table)
        {
            $table->dropColumn('source');
            $table->dropColumn('ip');
            $table->dropColumn('image');
        });
    }
}
