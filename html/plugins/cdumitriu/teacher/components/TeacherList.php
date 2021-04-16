<?php


namespace Cdumitriu\Teacher\Components;
use cdumitriu\Teacher\Models\Teacher;

class TeacherList extends \Cms\Classes\ComponentBase
{

    public $teachers;

    /**
     * @inheritDoc
     */
    public function componentDetails()
    {
        return [
                   'name' => 'Teacher List',
                    'description' => 'List of the received teachers'
               ];
    }

    protected function loadTeachers()
    {
        return Teacher::all();
    }

    public function onRun()
    {
        $this->teachers = $this->loadTeachers();
        //dd($this->teachers);
    }

}
