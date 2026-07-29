<?php

namespace App\Services;

use App\Models\Student;
use App\Support\ArabicNormalizer;

class StudentSearchService
{
    public function search(array $data): ?Student
    {
        if (isset($data['seating_no'])) {

            return Student::where(
                'seating_no',
                $data['seating_no']
            )->first();
        }

        $name = ArabicNormalizer::normalize($data['arabic_name']);

        return Student::whereRaw("
            REPLACE(
            REPLACE(
            REPLACE(
            REPLACE(arabic_name,'أ','ا'),
            'إ','ا'),
            'آ','ا'),
            'ى','ي')
            = ?
        ", [$name])->first();
    }
}
