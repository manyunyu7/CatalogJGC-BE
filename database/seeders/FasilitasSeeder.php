<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $data = [
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_atm.png',
            'name' => 'ATM',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_balkon.png',
            'name' => 'Balkon',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_jalur_lari.png',
            'name' => 'Jalur Lari',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_kartu_akses.png',
            'name' => 'Kartu Akses',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_kolam_renang.png',
            'name' => 'Kolam Renang',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_security.png',
            'name' => 'Security',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_shower.png',
            'name' => 'Shower',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_taman.png',
            'name' => 'Taman',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_wastafel.png',
            'name' => 'Wastafel',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ],
        [
            'icon' => '/web_files/fasilitas_image/fasilitas_wifi.png',
            'name' => 'Wi-Fi',
            'created_by' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]
    ];

    DB::table('fasilitas')->insert($data);
}
}
