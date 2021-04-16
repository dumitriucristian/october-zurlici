<?php namespace cdumitriu\Teacher\Models;

use Model;


/**
 * Model
 */
class Teacher extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'cdumitriu_teacher_details';

    public $attachOne = [
        'letter' => 'System\Models\File'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
