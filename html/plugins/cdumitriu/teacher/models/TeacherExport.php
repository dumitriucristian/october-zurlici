<?php


namespace cdumitriu\Teacher\Models;

use Backend\Models\ExportModel;
use cdumitriu\Teacher\Models\Teacher as Teacher;

class TeacherExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $teachers = Teacher::all();
        $teachers->each(function($teacher) use ($columns) {
            $teacher->addVisible($columns);
        });
        return $teachers->toArray();
    }

}
