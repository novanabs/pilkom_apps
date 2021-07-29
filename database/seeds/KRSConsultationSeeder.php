<?php

use Illuminate\Database\Seeder;

class KRSConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2	Dr. Harja Santanapurba, M.Kom	harja.sp@ulm.ac.id
        // 3	Dr. R. Ati Sukmawati, M.Kom	atisukmawati@ulm.ac.id	
        // 4	Dr. Andi Ichsan Mahardika, M. Pd	
        // 5	Mitra Pramita, M.Pd	mitrapramita92@ulm.ac.id	
        // 6	Delsika Pramata Sari, M.Pd	delsika.math@ulm.ac.id	
        // 7	Nuruddin Wiranda, M.kom., M.Cs	nuruddin.wd@ulm.ac.id	
        // 9	Muhammad Hifdzi Adini, S.Kom., M.T	hifdzi.adini@ulm.ac.id	

        // A1C615017
        // A1C615046
        // 1610131210019
        // 1610131310003
        // A1C615011
        // 1610131220018
        // 1610131320015
        // 1610131210001
        // 1710131210002
        // 1710131320042

        $krs_consultation = [
            [
            'id' => '1',
            'student_id' => "A1C615017",
            'user_id' => '2',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],[
            'id' => '2',
            'student_id' => "A1C615046",
            'user_id' => '2',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],
        [
            'id' => '3',
            'student_id' => "1610131210019",
            'user_id' => '3',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],
        [
            'id' => '4',
            'student_id' => "1610131310003",
            'user_id' => '3',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'SEBAGIAN DILIHAT',
        ],
        [
            'id' => '5',
            'student_id' => "A1C615011",
            'user_id' => '5',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],
        [
            'id' => '6',
            'student_id' => "1710131210002",
            'user_id' => '5',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'SUDAH DILIHAT',
        ],
        [
            'id' => '7',
            'student_id' => "1610131220018",
            'user_id' => '6',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],
        [
            'id' => '8',
            'student_id' => "1610131320015",
            'user_id' => '7',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],
        [
            'id' => '9',
            'student_id' => "1610131210001",
            'user_id' => '9',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'BELUM DILIHAT',
        ],
        [
            'id' => '10',
            'student_id' => "1710131320042",
            'user_id' => '9',
            'slip_ukt' => 'google.com',
            'khs' => 'google.com',
            'transkrip' => 'google.com',
            'krs_sementara' => 'google.com',
            'status' => 'SEBAGIAN DILIHAT',
        ]
        ];
        
        DB::table('krs_consultations')->insert($krs_consultation);
    }
}