<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1	id	bigint(20) unsigned	NULL	NULL	NO	NULL	auto_increment		
        // 2	name	varchar(50)	utf8mb4	utf8mb4_unicode_ci	NO	NULL			
        // 3	email	varchar(40)	utf8mb4	utf8mb4_unicode_ci	YES	NULL			
        // 4	email_verified_at	timestamp	NULL	NULL	YES	NULL			
        // 5	password	varchar(255)	utf8mb4	utf8mb4_unicode_ci	NO	NULL			
        // 6	address	varchar(100)	utf8mb4	utf8mb4_unicode_ci	YES	NULL			
        // 7	phonenumber	varchar(15)	utf8mb4	utf8mb4_unicode_ci	YES	NULL			
        // 8	NIP_NIK	varchar(30)	utf8mb4	utf8mb4_unicode_ci	YES	NULL			
        // 9	NIDN	varchar(30)	utf8mb4	utf8mb4_unicode_ci	YES	NULL			
        // 10	job_title_id	varchar(20)	utf8mb4	utf8mb4_unicode_ci	NO	NULL		job_titles(id)	
        // 11	group_id	varchar(20)	utf8mb4	utf8mb4_unicode_ci	NO	NULL		groups(id)	
        // 12	remember_token	varchar(100)	utf8mb4	utf8mb4_unicode_ci	YES	NULL			
        // 13	created_at	timestamp	NULL	NULL	YES	NULL			
        // 14	updated_at	timestamp	NULL	NULL	YES	NULL

        $users = [
            [
                // 'id'
            ]
        ];
        DB::table('users')->insert($users);
    }
}
