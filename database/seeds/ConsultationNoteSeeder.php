<?php

use Illuminate\Database\Seeder;

class ConsultationNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consultation_note = [[
            'krs_consultation_id' => '1',
            'status' => "DISETUJUI",
            'comment' => NULL,
        ],[
            'krs_consultation_id' => '2',
            'status' => "DISETUJUI",
            'comment' => NULL,
        ],[
            'krs_consultation_id' => '3',
            'status' => "BELUM DISETUJUI",
            'comment' => "BELUM LENGKAP",
        ],[
            'krs_consultation_id' => '4',
            'status' => "BELUM DISETUJUI",
            'comment' => "BELUM LENGKAP",
        ]
        ];
        
        DB::table('consultation_notes')->insert($consultation_note);
    }
}