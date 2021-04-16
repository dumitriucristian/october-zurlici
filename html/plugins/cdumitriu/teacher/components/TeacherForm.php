<?php
    namespace Cdumitriu\Teacher\Components;
    use cdumitriu\Teacher\Models\Teacher;

    use Cms\Classes\ComponentBase;
    use October\Rain\Exception\ValidationException;
    use October\Rain\Support\Facades\Validator;
    use October\Rain\Support\Facades\Input;
    use October\Rain\Support\Facades\Flash;
    use System\Models\File;

    class TeacherForm extends ComponentBase
    {

        public function componentDetails()
        {
          return [
              'name' => 'Teacher Form',
              'description' => 'Add teacher'
          ];

        }

        public function onImageUpload()
        {
            $image = Input::all();
            $file = (new File())->fromPost($image['letter']);
            return [
                '#imageResult' => '<img src="'.$file->getThumb(200,200, ['mode'=>'crop']). '">'
            ];

        }

        public function onSend()
        {
            $userName = Input::get('user-name');
            $userEmail = Input::get('user-email');
            $teacherName = Input::get('teacher-name');
            $teacherDetails = Input::get('teacher-details');
            $letter = Input::file('letter');
            $form = Input::all();

            $rules = [
                'user-name' => 'required',
                'user-email' => 'required',
                'teacher-name' => 'required',
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
            $teacher->letter = $letter;
            $teacher->save();

            //send confirmation email

            // redirect user to teacher page;
            Flash::success("Am primit invatatoarea");
        }
    }
