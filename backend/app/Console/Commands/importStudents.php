<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SplFileObject;
use Throwable;

class ImportStudents extends Command
{
    /**
     * Command signature.
     */
    protected $signature = 'students:import {file}';

    /**
     * Command description.
     */
    protected $description = 'Import students from a CSV file';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $startTime = microtime(true);

        $filePath = $this->argument('file');



        // Check file exists
        if (! file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return self::FAILURE;
        }

        // Ask before deleting old data
        if (Student::exists()) {
            if (! $this->confirm('Students table already contains data. Truncate it before importing?')) {
                $this->warn('Import cancelled.');
                return self::SUCCESS;
            }

            DB::table('students')->truncate();
        }

        $this->info('Opening CSV file...');

        $file = new SplFileObject($filePath);

        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY
        );

        // -----------------------------
        // Validate Header
        // -----------------------------

        $header = $file->fgetcsv();


        $header = array_map(function ($value) {
            return trim(preg_replace('/^\xEF\xBB\xBF/', '', $value));
        }, $header);

        

        $expectedHeader = [
            'seating_no',
            'arabic_name',
            'total_degree',
            'student_case_desc',
        ];

        if ($header !== $expectedHeader) {
            $this->error('Invalid CSV header.');

            $this->line('Expected:');
            $this->line(implode(', ', $expectedHeader));

            $this->line('Received:');
            $this->line(implode(', ', $header));

            return self::FAILURE;
        }

        $this->info('Header validated successfully.');

        $batch = [];
        $batchSize = 1000;

        $imported = 0;
        $skipped = 0;

        $progressBar = $this->output->createProgressBar();
        $progressBar->start();

        foreach ($file as $row) {

            $progressBar->advance();

            // Ignore blank rows
            if (empty($row) || $row[0] === null) {
                continue;
            }

            // Validate number of columns
            if (count($row) !== 4) {
                $skipped++;
                continue;
            }

            // Validate required fields
            if (
                trim($row[0]) === '' ||
                trim($row[1]) === '' ||
                trim($row[2]) === '' ||
                trim($row[3]) === ''
            ) {
                $skipped++;
                continue;
            }

            $batch[] = [
                'seating_no'       => (int) $row[0],
                'arabic_name'      => trim($row[1]),
                'total_degree'     => (float) $row[2],
                'student_case_desc'=> trim($row[3]),
            ];

            if (count($batch) === $batchSize) {

                DB::beginTransaction();

                try {

                    DB::table('students')->insert($batch);

                    DB::commit();

                } catch (Throwable $e) {

                    DB::rollBack();

                    $this->newLine();
                    $this->error($e->getMessage());

                    return self::FAILURE;
                }

                $imported += count($batch);

                $batch = [];
            }
        }

        // Insert remaining rows
        if (! empty($batch)) {

            DB::beginTransaction();

            try {

                DB::table('students')->insert($batch);

                DB::commit();

            } catch (Throwable $e) {

                DB::rollBack();

                $this->newLine();
                $this->error($e->getMessage());

                return self::FAILURE;
            }

            $imported += count($batch);
        }

        $progressBar->finish();

        $executionTime = round(microtime(true) - $startTime, 2);

        $this->newLine(2);

        $this->info('Import completed successfully.');

        $this->table(
            ['Statistic', 'Value'],
            [
                ['Imported Students', number_format($imported)],
                ['Skipped Rows', number_format($skipped)],
                ['Execution Time', "{$executionTime} seconds"],
            ]
        );

        return self::SUCCESS;
    }
}
