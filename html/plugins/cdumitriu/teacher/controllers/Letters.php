<?php
namespace cdumitriu\Teacher\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use cdumitriu\Teacher\Models\Letter;
use Illuminate\Support\Facades\Redirect;

class Letters extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('cdumitriu.Teacher', 'main-menu-item', 'side-menu-item');
    }

    public function onExport()
    {
        $columns = [
            'id',
            'nume invatator',
            'apreciere',
            'detalii-apreciere',
            'creat in',
            'mume utilizator',
            'ip',
            'sursa',
            'imagine'
        ];


        try {

            $fileName = 'scrisoare-apreciere.csv';

            $file = fopen(storage_path('app/csv/' . $fileName), 'w+');
            fputcsv($file, $columns);
            $letters = Letter::all();
            foreach ($letters as $letter) {
                $row['id'] = $letter->id;
                $row['teacher_name'] = $letter->teacher_name   . ' ' . $letter->teacher_surname;
                $row['appreciation'] = $letter->apreciation;
                $row['appreciation_details'] = $letter->letter;
                $row['created_at'] = $letter->created_at;
                $row['student_name'] = $letter->student_name . ' ' .$letter->student_surname;
                $row['ip'] = $letter->ip;
                $row['sursa'] = $letter->sursa;
                $row['image'] = $letter->file;

                fputcsv($file, [
                    $row['id'],
                    $row['teacher_name'],
                    $row['appreciation'],
                    $row['appreciation_details'],
                    $row['created_at'],
                    $row['student_name'],
                    $row['ip'],
                    $row['sursa'],
                    $row['image']
                ]);
            }
            fclose($file);
        }catch(\Exception $e){
           // var_dump( $e->getMessage());
        }
        return  Redirect::to('/export')->with('page', $fileName);
    }
}
