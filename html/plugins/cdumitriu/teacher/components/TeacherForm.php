<?php
    namespace Cdumitriu\Teacher\Components;
    use cdumitriu\Teacher\Models\Teacher;

    use Cms\Classes\ComponentBase;
    use Illuminate\Support\Facades\Redirect;
    use October\Rain\Exception\ValidationException;
    use October\Rain\Support\Facades\Validator;
    use October\Rain\Support\Facades\Input;
    use Intervention\Image\Facades\Image;
    use Illuminate\Support\Facades\Request;

    class TeacherForm extends ComponentBase
    {
        private $userName;
        private $userSurname;
        private $userEmail;
        private $teacherName;
        private $teacherSurname;
        private $teacherDetails;
        private $teacherSchool;
        private $teacherCity;
        private $teacherCounty;

        public function componentDetails()
        {
          return [
              'name' => 'Teacher Form',
              'description' => 'Add teacher'
          ];
        }

        private function validateInput()
        {
            $this->userName = Input::get('user-name');
            $this->userSurname= Input::get('user-surname');
            $this->userEmail = Input::get('user-email');
            $this->teacherName = Input::get('teacher-name');
            $this->teacherSurname = Input::get('teacher-surname');
            $this->teacherDetails = Input::get('teacher-details');
            $this->teacherSchool = Input::get('teacher-school');
            $this->teacherCity = Input::get('teacher-city');
            $this->teacherCounty = Input::get('teacher-county');

            $form = Input::all();

            $rules = [
                'user-name' => 'required',
                'user-surname' => 'required',
                'user-email' => 'required',
                'teacher-name' => 'required',
                'teacher-surname' => 'required',
                'teacher-city' => 'required',
                'teacher-county' => 'required',
                'teacher-school' => 'required',
                'teacher-details' => 'required'
            ];

            $validator = Validator::make($form,$rules);
            if($validator->fails()) {
                throw new ValidationException($validator);
            }

        }

        public function onCreate()
        {
            $this->validateInput();
            $this->generateImage();
            $image =  media_path('/teachers/base-image.jpg');
            $this->page['preview_content'] = $image.'?id='.random_int(2,50);

            return [
                '#imageResult' => $this->renderPartial('preview')
            ];
        }



        public function onSend(){

            $this->validateInput();
            //@todo time function should be replaced with laravel time functions

            //saveImage
            $customName = strtolower( $this->teacherName .'_'. $this->teacherSurname.'_'.time().'.jpg');
            $imagePath = strtolower( 'app/media/teachers/').$customName;

            $this->generateImage($imagePath);

            //save user data
            $teacher = new Teacher();
            $teacher->image = $customName;
            $teacher->user_name = $this->userName;
            $teacher->user_surname = $this->userSurname;
            $teacher->user_email = $this->userEmail;
            $teacher->teacher_name = $this->teacherName;
            $teacher->teacher_surname = $this->teacherSurname;
            $teacher->teacher_details = $this->teacherDetails;
            $teacher->city = $this->teacherCity;
            $teacher->teacher_county = $this->teacherCounty;
            $teacher->school = $this->teacherSchool;
            $teacher->year = 2021;
            $teacher->ip = Request::ip();
            // $teacher->letter = $letter;
            $teacher->save();

            // redirect user to teacher page;
            return Redirect::to('/succes?f='.$customName);
        }


        private function generateImage( $imagePath=null)
        {
            $originalImage = public_path('public/gift.jpeg');

            // create Image from file
            $img = Image::make($originalImage)->fit(600,600);

            $lines = explode("\n", wordwrap($this->teacherDetails, 40));

            for ($i = 0; $i < count($lines); $i++) {
                $offset = 22 + ($i * 50);
                $img->text($lines[$i], 300, $offset, function ($font) {
                    $font->color('#1500ff');
                    $font->size(24);
                    $font->file(storage_path('fonts/SourceSansPro-Black.ttf'));
                    $font->align('center');
                    $font->valign('top');
                });
            }

            $fileName = (is_null($imagePath)) ? 'app/media/teachers/base-image.jpg' : $imagePath;
            $img->save(storage_path($fileName));

            return $img;
        }
    }
