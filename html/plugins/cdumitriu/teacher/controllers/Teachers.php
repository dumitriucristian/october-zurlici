<?php namespace cdumitriu\Teacher\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use cdumitriu\Teacher\Models\Teacher;
use Illuminate\Support\Facades\Redirect;

class Teachers extends Controller
{

    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
        'Backend\Behaviors\ImportExportController'

    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('cdumitriu.Teacher', 'main-menu-item', 'side-menu-item');
    }
    public function onExport()
    {
        $columns = [
            'id',
            'email utilizator',
            'nume invatator',
            'detalii',
            'creat in',
            'mume utilizator',
            'scoala',
            'an',
            'oras',
            'judet',
            'ip',
            'sursa',
            'imagine'

        ];


        try {

            $fileName = 'invatatoarea-anului.csv';

            $file = fopen(storage_path('app/csv/' . $fileName), 'w+');
            fputcsv($file, $columns);
            $teachers = Teacher::all();
            foreach ($teachers as $teacher) {
                $row['id'] = $teacher->id;
                $row['user-email'] = $teacher->user_email;
                $row['teacher_name'] = $teacher->teacher_name   . ' ' . $teacher->teacher_surname;
                $row['teacher_details'] = $teacher->teacher_details;
                $row['created_at'] = $teacher->created_at;
                $row['user_name'] = $teacher->user_name . ' ' .$teacher->user_surname;;
                $row['scoala'] = $teacher->school;
                $row['year'] = $teacher->year;
                $row['teacher_city'] = $teacher->teacher_city;
                $row['teacher_county'] = $teacher->teacher_county;
                $row['ip'] = $teacher->ip;
                $row['sursa'] = $teacher->source;
                $row['image'] = $teacher->image;


                fputcsv($file, [
                    $row['id'],
                    $row['user-email'],
                    $row['teacher_name'],
                    $row['teacher_details'],
                    $row['created_at'],
                    $row['user_name'],
                    $row['scoala'],
                    $row['year'],
                    $row['teacher_city'],
                    $row['teacher_county'],
                    $row['ip'],
                    $row['sursa'],
                    $row['image']
                ]);
            }
            fclose($file);
        }catch(\Exception $e){
            //var_dump( $e->getMessage());
        }
        return  Redirect::to('/export')->with('page', $fileName);
    }
}
