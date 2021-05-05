<?php
    namespace Cdumitriu\Teacher\Components;
    use cdumitriu\Teacher\Models\Teacher;

    use Cms\Classes\ComponentBase;
    use October\Rain\Exception\ValidationException;
    use October\Rain\Support\Facades\Validator;
    use October\Rain\Support\Facades\Input;
    use October\Rain\Support\Facades\Flash;
    use System\Models\File;
    use Intervention\Image\Facades\Image;

    class TeacherForm extends ComponentBase
    {

        public function componentDetails()
        {
          return [
              'name' => 'Teacher Form',
              'description' => 'Add teacher'
          ];
        }

        public function onCreate()
        {
            $userName = Input::get('user-name');
            $userEmail = Input::get('user-email');
            $teacherName = Input::get('teacher-name');
            $teacherDetails = Input::get('teacher-details');
            $teacherSchool = Input::get('teacher-school');
            $teacherCity = Input::get('teacher-city');

            $form = Input::all();

            $rules = [
                'user-name' => 'required',
                'user-email' => 'required',
                'teacher-name' => 'required',
                'teacher-city' => 'required',
                'teacher-school' => 'required',
            ];

            $image = $this->generateImage($teacherDetails);

            $file = media_path('/teachers/test.jpg');
            //validate user input
            $validator = Validator::make($form,$rules);
            if($validator->fails()) {
                throw new ValidationException($validator);
            }

            return [
                '#imageResult' => '<img src="'.$file. '">'
            ];


        }

        public function onSend(){

            $userName = Input::get('user-name');
            $userSurname= Input::get('user-surname');
            $userEmail = Input::get('user-email');
            $teacherName = Input::get('teacher-name');
            $teacherSurname = Input::get('teacher-surname');
            $teacherDetails = Input::get('teacher-details');
            $teacherSchool = Input::get('teacher-school');
            $teacherCity = Input::get('teacher-city');
            $teacherCounty = Input::get('teacher-county');

            $form = Input::all();

            $rules = [
                'user-name' => 'required',
                'user-email' => 'required',
                'user-surname' => 'required',
                'teacher-name' => 'required',
                'teacher-surname' => 'required',
                'teacher-city' => 'required',
                'teacher-county' => 'required',
                'teacher-school' => 'required',
            ];

            $validator = Validator::make($form,$rules);
            if($validator->fails()) {
                throw new ValidationException($validator);
            }

            //save user data
            $teacher = new Teacher();
            $teacher->user_name = $userName;
            $teacher->user_surname = $userSurname;
            $teacher->user_email = $userEmail;
            $teacher->teacher_name = $teacherName;
            $teacher->teacher_surname = $teacherSurname;
            $teacher->teacher_details = $teacherDetails;
            $teacher->city = $teacherCity;
            $teacher->teacher_county = $teacherCounty;
            $teacher->school = $teacherSchool;
            $teacher->year = 2021;
            // $teacher->letter = $letter;
            $teacher->save();

            // redirect user to teacher page;
           return Flash::success("Am primit invatatoarea");
        }


        private function generateImage($teacherDetails)
        {
            $originalImage = public_path('public/gift.jpeg');
            // create Image from file
            $img = Image::make($originalImage)->fit(600,600);

            $lines = explode("\n", wordwrap($teacherDetails, 40));

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
            $fileName = storage_path('app/media/teachers/test.jpg');
            $img->save($fileName);

            return $img;
        }
    }
