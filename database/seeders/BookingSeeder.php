<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert tomorrow's date random , 2 data
        $date = date('Y-m-d', strtotime('+1 day'));
        $first = [
            'name' => 'Meeting',
            'tanggal' => $date,
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
        ];
        $second = [
            'name' => 'Rapat',
            'tanggal' => $date,
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
        ];
        DB::table('booking')->insert([$first, $second]);
    }
}
