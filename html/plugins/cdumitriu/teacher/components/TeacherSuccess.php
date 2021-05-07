<?php


namespace Cdumitriu\Teacher\Components;


use Cms\Classes\ComponentBase;
use cdumitriu\Teacher\Models\Teacher;
use Illuminate\Support\Facades\Response;

class TeacherSuccess extends ComponentBase
{
    /**
     * @inheritDoc
     */
    public function componentDetails()
    {
        return [
            'name' => 'Teacher success',
            'description' => 'Teacher succes page'
        ];
    }

    public function onRun()
    {

        if( empty($this->param('teacher'))) {
            //@todo acces denied or ups page
            return Response::make('Access denied!', 403);
        }

        try{
            $teacher = Teacher::findOrFail($this->param('teacher'));
            $this->page['teacherName'] = $teacher->teacher_name;
            $this->page['teacherSurname'] = $teacher->teacher_surname;
            $this->page['image']  = media_path('/teachers/'.$teacher->image);

        }catch(\Exception $e){

            return Response::make('Access denied!', 403);

        }

    }
}
