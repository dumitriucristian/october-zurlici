<?php namespace cdumitriu\Teacher;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
            return [
              'Cdumitriu\Teacher\Components\TeacherForm' => 'TeacherForm',
              'Cdumitriu\Teacher\Components\TeacherList'  => 'TeacherList',
              'Cdumitriu\Teacher\Components\TeacherDetails'  => 'TeacherDetails',
              'Cdumitriu\Teacher\Components\TeacherPage'  => 'teacherPage',
              'Cdumitriu\Teacher\Components\TeacherSuccess' => 'TeacherSuccess',
              'Cdumitriu\Teacher\Components\LetterForm' => 'LetterForm'

            ];
    }

    public function registerSettings()
    {
    }
}
