<?php namespace cdumitriu\Teacher\Models;

use Model;

/**
 * Model
 */
class Letter extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'cdumitriu_teacher_letters';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
