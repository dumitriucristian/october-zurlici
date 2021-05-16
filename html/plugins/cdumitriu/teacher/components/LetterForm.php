<?php
namespace Cdumitriu\Teacher\Components;

use cdumitriu\Teacher\Models\Letter;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use October\Rain\Database\Model;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Validator;
use October\Rain\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Request;


class LetterForm extends ComponentBase
{
    private $studentName;
    private $studentSurname;
    private $teacherName;
    private $teacherSurname;
    private $appreciation;
    private $letter;


    public function componentDetails()
    {
        return [
            'name' => 'Letter Form',
            'description' => 'Add letter'
        ];
    }


    /*
     * do not delete - required for test
     * @todo move this into a test page
     */


    public function onCreate()
    {

        $this->validateInput();
        $this->generateImageSissi();

        $image =  media_path('/teachers/scrisoare.png');
        $this->page['preview_content'] = $image.'?id='.random_int(2,50);
        $this->page['preview'] = true;

        return [
            '#buttons' => $this->renderPartial('@buttons'),
            '#imageResult' => $this->renderPartial('@preview')
        ];
    }

    public function onSend(){


        $this->validateInput();
        //@todo time function should be replaced with laravel time functions

        //saveImage
        $customName = strtolower( $this->teacherName .'_'. $this->teacherSurname.'_'.time().'.png');
        $imagePath = strtolower( 'app/media/teachers/letter/').$customName;
        $this->generateImageSissi($imagePath);

        //save user data
        $letter = new Letter();
        $letter->file = $customName;
        $letter->student_name = $this->studentName;
        $letter->student_surname = $this->studentSurname;
        $letter->teacher_name = $this->teacherName;
        $letter->teacher_surname = $this->teacherSurname;
        $letter->apreciation = $this->appreciation;
        $letter->letter = $this->letter;
        $letter->sursa="sissi";

        $letter->ip = Request::ip();
        $letter->save();
        Session::put('letter',$letter->getKey());
        return Redirect::to('/scrisoare-succes/'.hash('crc32',$letter->getKey()));

    }

    private function generateImageSissi($imagePath=null)
    {
        $originalImage = public_path('public/scrisoare.png');

        $img = Image::make($originalImage)->fit(610,768);
        $img->text($this->teacherName . ' ' .$this->teacherSurname, 120, 700, function ($font) {
            $font->color('#000');
            $font->size(20);
            $font->file(storage_path('fonts/DancingScript-Bold.ttf'));
            $font->align('left');
            $font->valign('top');
        });
        $img->text($this->studentName . ' ' .$this->studentSurname, 120, 110, function ($font) {
            $font->color('#000');
            $font->size(30);
            $font->file(storage_path('fonts/DancingScript-Bold.ttf'));
            $font->align('left');
            $font->valign('top');
        });
        $img->text($this->appreciation, 120, 190, function ($font) {
            $font->color('#000');
            $font->size(20);
            $font->file(storage_path('fonts/DancingScript-Bold.ttf'));
            $font->align('left');
            $font->valign('top');
        });


        $lines = explode("\n", wordwrap($this->letter, 45));

        for ($i = 0; $i < count($lines); $i++) {
            $offset = 240 + ($i * 30);

            $img->text($lines[$i], 120, $offset, function ($font) {
                $font->color('#000');
                $font->size(22);
                $font->file(storage_path('fonts/DancingScript-Bold.ttf'));
                $font->align('left');
                $font->valign('top');
            });
        }

        $fileName = (is_null($imagePath)) ? 'app/media/teachers/letter/scrisoare.png' : $imagePath;
        $img->save(storage_path($fileName));

        return $img;
    }

    private function validateInput()
    {
        $this->studentName = Input::get('student-name');
        $this->studentSurname= Input::get('student-surname');
        $this->teacherName = Input::get('teacher-name');
        $this->teacherSurname = Input::get('teacher-surname');
        $this->appreciation = Input::get('subject');
        $this->letter = Input::get('letter');

        $form = Input::all();

        $rules = [
            'student-name' => 'required',
            'student-surname' => 'required',
            'teacher-name' => 'required',
            'teacher-surname' => 'required',
            'subject' => 'required',
            'letter' => 'required'
        ];

        $validator = Validator::make($form,$rules);
        if($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
