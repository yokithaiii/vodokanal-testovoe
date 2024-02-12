<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Material;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\Enrollment;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->parseCSV('materials.csv', Material::class);
        $this->parseCSV('students.csv', Student::class);
        $this->parseCSV('teachers.csv', Teacher::class);
        $this->parseCSV('courses.csv', Course::class);
        $this->parseCSV('course_materials.csv', CourseMaterial::class);
        $this->parseCSV('enrollments.csv', Enrollment::class);
        
        $this->info('Data imported successfully.');
    }

    public function parseCSV($filename, $model)
    {
        $path = storage_path("/data/{$filename}");
    
        if (file_exists($path)) {

            $data = array_map('str_getcsv', file($path));
            array_shift($data);

            if (count($data) >= 500) {
                $k = 500;
            } else {
                $k = count($data);
            }

            for ($i = 0; $i < $k; $i++) { //Ограничил в 500 записей, так как данных слишком много
                $modelInstance = new $model;
                $modelInstance->updateOrCreate(array_combine($modelInstance->getFillable(), $data[$i]));
            }
            
            // foreach ($data as $row) {
            //     $modelInstance = new $model;
            //     $modelInstance->updateOrCreate(array_combine($modelInstance->getFillable(), $row));
            // }
            
            // dd($data);
            // dd($modelInstance->getFillable());

        } else {
            \Log::error("File not found: $filename");
        }
    }

}
