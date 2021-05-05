<?php


namespace Cdumitriu\Teacher\Components;

use Cms\Classes\ComponentBase;

class TeacherPage extends ComponentBase
{
    /**
     * @inheritDoc
     */
    public function componentDetails()
    {
        return [
            'name' => 'Teacher Page',
            'description' => 'Teacher page'
        ];
    }

    public function onRun()
    {
       $this->data = "test";
    }
}
