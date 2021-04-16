<?php


namespace Cdumitriu\Teacher\Components;


use Cms\Classes\ComponentBase;

class TeacherDetails extends ComponentBase
{
    /**
     * @inheritDoc
     */
    public function componentDetails()
    {
        return [
            'name' => 'Teacher Details',
            'description' => 'Teacher page'
        ];
    }
}
