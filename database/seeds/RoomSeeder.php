<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [1,'Ruang 25'],[2, 'Ruang 26'],[3,'Zoom Meeting']
        ];
        DB::table('rooms')->insert($rooms);
    }
}
