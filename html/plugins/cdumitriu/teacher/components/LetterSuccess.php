<?php


namespace Cdumitriu\Teacher\Components;


use Cms\Classes\ComponentBase;
use cdumitriu\Teacher\Models\Letter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
class LetterSuccess extends ComponentBase
{
    /**
     * @inheritDoc
     */
    public function componentDetails()
    {
        return [
            'name' => 'Letter success',
            'description' => 'Letter succes page'
        ];
    }

    public function onRun()
    {

        if( empty($this->param('letter'))) {
            //@todo acces denied or ups page
            return Response::make('Access denied!', 403);
        }

        try{
            $letter = Letter::findOrFail(Session::get('letter'));
            $this->page['teacherName'] = $letter->teacher_name;
            $this->page['teacherSurname'] = $letter->teacher_surname;
            $this->page['image']  = media_path('/teachers/letter/'.$letter->file);
            Session::forget('letter');
        }catch(\Exception $e){

            return Response::make('Access denied!', 403);
        }
    }
}
