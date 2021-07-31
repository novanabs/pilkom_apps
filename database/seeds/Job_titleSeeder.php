<?php

use Illuminate\Database\Seeder;

class Job_titleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_titles = [
            ['Dosen'],['Koordinator Prodi'],['Operator'],['Dosen Non Homebase']
         ];
         DB::table('job_titles')->insert($job_titles);
    }
}
