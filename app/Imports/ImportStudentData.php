<?php

namespace App\Imports;

use App\Models\Student_list;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportStudentData implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $studentId = $row['student_id'];

        // Check if the student ID already exists in the database
        $existingStudent = Student_list::where('student_id', $studentId)->first();

        // If the student ID doesn't exist, create a new record
        if (!$existingStudent) {
            return new Student_list([
                'student_id' => $row['student_id'],
                'name' => $row['name'],
                'course' => $row['course'],
                'barcode' => $row['barcode']
            ]);
        } else {
            // If the student ID already exists, skip this row
            return null;
        }
    }
}
