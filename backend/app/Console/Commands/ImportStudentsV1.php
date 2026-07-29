<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;

// use App\Models\Student;
// use Illuminate\Support\Facades\DB;
// use SplFileObject;


// class ImportStudentsV1 extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'studentsV1:import {file}';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Import students from a CSV file';
//     /**
//      * Execute the console command.
//      */
//     public function handle(): int
//     {
//         $filePath = $this->argument('file');

//         if (! file_exists($filePath)) {
//             $this->error("File not found: {$filePath}");
//             return self::FAILURE;
//         }

//         if (Student::exists()) {
//             if (! $this->confirm('Students table already contains data. Truncate it?')) {
//                 $this->warn('Import cancelled.');
//                 return self::SUCCESS;
//             }

//             DB::table('students')->truncate();
//         }

//         $this->info('Reading CSV...');

//         $file = new SplFileObject($filePath);
//         $file->setFlags(
//             SplFileObject::READ_CSV |
//             SplFileObject::SKIP_EMPTY
//         );

//         // Skip header
//         $file->fgetcsv();

//         $batch = [];
//         $batchSize = 1000;
//         $imported = 0;

//         foreach ($file as $row) {

//             if (empty($row) || $row[0] === null) {
//                 continue;
//             }

//             $batch[] = [
//                 'seating_no' => (int) $row[0],
//                 'arabic_name' => trim($row[1]),
//                 'total_degree' => (float) $row[2],
//                 'student_case_desc' => trim($row[3]),
//             ];

//             if (count($batch) === $batchSize) {

//                 DB::table('students')->insert($batch);

//                 $imported += count($batch);

//                 $this->info("Imported {$imported} students...");

//                 $batch = [];
//             }
//         }

//         if (! empty($batch)) {
//             DB::table('students')->insert($batch);

//             $imported += count($batch);
//         }

//         $this->newLine();
//         $this->info("Successfully imported {$imported} students.");

//         return self::SUCCESS;
//     }
// }
