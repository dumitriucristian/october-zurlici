<?php namespace cdumitriu\Teacher\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateCdumitriuTeacherDetails extends Migration
{
    public function up()
    {
        Schema::create('cdumitriu_teacher_details', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('teacher_name');
            $table->text('teacher_details');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('cdumitriu_teacher_details');
    }
}
