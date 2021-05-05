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
/*
        public function onImageUpload()
        {
            $image = Input::all();
            $file = (new File())->fromPost($image['letter']);
            return [
                '#imageResult' => '<img src="'.$file->getThumb(200,200, ['mode'=>'crop']). '">'
            ];

        }
*/
        public function onCreate()
        {
            $userName = Input::get('user-name');
            $userEmail = Input::get('user-email');
            $teacherName = Input::get('teacher-name');
            $teacherDetails = Input::get('teacher-details');
            $teacherSchool = Input::get('teacher-school');
            $teacherCity = Input::get('teacher-city');

           // $letter = Input::file('letter');

            $form = Input::all();

            $rules = [
                'user-name' => 'required',
                'user-email' => 'required',
                'teacher-name' => 'required',
                'teacher-city' => 'required',
                'teacher-school' => 'required',
            ];
          //  var_dump( storage_path('teachers/test.jpg'));
           // die();
            $image = $this->generateImage($teacherDetails);
            //$file = (new File())->fromPost($image['letter']);
            $file = media_path('/teachers/test.jpg');//public_path('public/teachers/test.jpg');
          //  var_dump($file); die();
            return [
                '#imageResult' => '<img src="'.$file. '">'
            ];

            //validate user input
            $validator = Validator::make($form,$rules);
            if($validator->fails()) {
                throw new ValidationException($validator);
            }

            //save user data
            $teacher = new Teacher();
            $teacher->user_name = $userName;
            $teacher->user_email = $userEmail;
            $teacher->teacher_name = $teacherName;
            $teacher->teacher_details = $teacherDetails;
            $teacher->city = $teacherCity;
            $teacher->school = $teacherSchool;
            $teacher->year = 2021;
           // $teacher->letter = $letter;
            $teacher->save();

            //send confirmation email

            // redirect user to teacher page;
            Flash::success("Am primit invatatoarea");
        }


        private function generateImage($teacherDetails)
        {
            $originalImage = public_path('public/gift.jpeg');
            // create Image from file
            $img = Image::make($originalImage);


                       // use callback to define details
            /*
            $img->text('foo', 0, 0, function($font) {
                $font->file('foo/bar.ttf');
                $font->size(24);
                $font->color('#fdf6e3');
                $font->align('center');
                $font->valign('top');
                $font->angle(45);
            });
            */
            // draw transparent text
            $img->text($teacherDetails, 150, 150, function($font) {
                $font->color('#1500ff');
                $font->size(24);
                $font->file(storage_path('fonts/SourceSansPro-Black.ttf'));
                $font->align('center');

            });

            $fileName = storage_path('app/media/teachers/test.jpg');
            $img->save($fileName);
            //var_dump($img);
            return $img;
        }
    }


