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
        private $typeSissi;
        private $newsletter;

        public function componentDetails()
        {
          return [
              'name' => 'Teacher Form',
              'description' => 'Add teacher'
          ];
        }


        private function setSissi()
        {
            $this->typeSissi = (Request::is('inscriere-sissi'))   ? true : false;
        }
        /*
         * do not delete - required for test
         * @todo move this into a test page
        public function onCreate()
        {
            $this->setSissi();
            $this->validateInput();
            if($this->typeSissi) {
                $this->generateImageSissi();
            }else{
                $this->generateImage();
            }
            $image =  ($this->typeSissi) ? media_path('/teachers/sissi_diploma.jpg') : media_path('/teachers/diploma_fng.jpg');
            $this->page['preview_content'] = $image.'?id='.random_int(2,50);
            $this->page['preview'] = true;

            return [
                '#buttons' => $this->renderPartial('@buttons'),
                '#imageResult' => $this->renderPartial('@preview')
            ];
        }
        */

        public function onSend(){

            $this->setSissi();
            $this->validateInput();
            //@todo time function should be replaced with laravel time functions

            //saveImage
            $customName = strtolower( $this->teacherName .'_'. $this->teacherSurname.'_'.time().'.jpg');
            $imagePath = strtolower( 'app/media/teachers/').$customName;

            if($this->typeSissi) {
                $this->generateImageSissi($imagePath);
            } else {
                $this->generateImage($imagePath);
            }

            //save user data
            $teacher = new Teacher();
            $teacher->image = $customName;
            $teacher->user_name = $this->userName;
            $teacher->user_surname = $this->userSurname;
            $teacher->user_email = $this->userEmail;
            $teacher->teacher_name = $this->teacherName;
            $teacher->teacher_surname = $this->teacherSurname;
            $teacher->teacher_details = $this->teacherDetails;
            $teacher->teacher_city = $this->teacherCity;
            $teacher->teacher_county = $this->teacherCounty;
            $teacher->school = $this->teacherSchool;
            $teacher->year = 2021;
            $teacher->ip = Request::ip();
             $teacher->newsletter = $this->newsletter;
            $teacher->source = ($this->typeSissi) ? "sissi" : "FNG";
            $teacher->save();

            //if inscriere-sissi
            if ($this->typeSissi) {
                return Redirect::to('/succes-sissi/'.$teacher->getKey());
            }
            // redirect user to teacher page;
            return Redirect::to('/succes/'.$teacher->getKey());
        }

        private function generateImageSissi($imagePath=null)
        {
            $originalImage = public_path('public/sissi_diploma.jpg');

            $img = Image::make($originalImage)->fit(1024,691);
            $img->text($this->teacherName . ' ' .$this->teacherSurname, 550, 160, function ($font) {
                $font->color('#00193f');
                $font->size(40);
                $font->file(storage_path('fonts/MYRIADPRO-REGULAR.OTF'));
                $font->align('center');
                $font->valign('top');
            });

            $img->text($this->teacherSchool, 550, 315, function ($font) {
                $font->color('#00193f');
                $font->size(26);
                $font->file(storage_path('fonts/MYRIADPRO-REGULAR.OTF'));
                $font->align('center');
                $font->valign('top');
            });

            $img->text($this->userName . ' ' .$this->userSurname, 550, 410, function ($font) {
                $font->color('#00193f');
                $font->size(26);
                $font->file(storage_path('fonts/MYRIADPRO-REGULAR.OTF'));
                $font->align('center');
                $font->valign('top');
            });


            //$lines = explode("\n", wordwrap($this->teacherDetails, 40));

            /*
            for ($i = 0; $i < count($lines); $i++) {
                $offset = 22 + ($i * 50);
                $img->text($lines[$i], 300, $offset, function ($font) {
                    $font->color('#1500ff');
                    $font->size(24);
                    $font->file(storage_path('fonts/SourceSansPro-Black.ttf'));
                    $font->align('center');
                    $font->valign('top');
                });
            }*/


            $fileName = (is_null($imagePath)) ? 'app/media/teachers/sissi_diploma.jpg' : $imagePath;
            $img->save(storage_path($fileName));

            return $img;
        }

        private function generateImage( $imagePath=null)
        {
            $originalImage = public_path('public/diploma_fng.jpg');

            $img = Image::make($originalImage)->fit(800,475);
            $img->text($this->teacherName . ' ' .$this->teacherSurname, 398, 125, function ($font) {
                $font->color('#fffff');
                $font->size(33);
                $font->file(storage_path('fonts/MYRIADPRO-BOLD.OTF'));
                $font->align('center');
                $font->valign('top');
            });
            $img->text($this->teacherName . ' ' .$this->teacherSurname, 398, 126, function ($font) {
                $font->color('#fffff');
                $font->size(33);
                $font->file(storage_path('fonts/MYRIADPRO-BOLD.OTF'));
                $font->align('center');
                $font->valign('top');
            });

            $img->text($this->teacherName . ' ' .$this->teacherSurname, 400, 128, function ($font) {
                $font->color('#ee4a9a');
                $font->size(33);
                $font->file(storage_path('fonts/MYRIADPRO-BOLD.OTF'));
                $font->align('center');
                $font->valign('top');
            });

            $img->text($this->teacherSchool, 400, 225, function ($font) {
                $font->color('#ffff');
                $font->size(22);
                $font->file(storage_path('fonts/MYRIADPRO-SEMIBOLDIT.OTF'));
                $font->align('center');
                $font->valign('top');
            });

            $fileName = (is_null($imagePath)) ? 'app/media/teachers/diploma_fng.jpg' : $imagePath;
            $img->save(storage_path($fileName));

            return $img;
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
            $this->newsletter = Input::get('newsletter');

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
                'teacher-details' => 'required|max:500'
            ];

            $validator = Validator::make($form,$rules);
            if($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
    }
