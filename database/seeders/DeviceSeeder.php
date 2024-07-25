<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            [
                'name' => 'Device 1',
                'description' => 'The device is a Microwave',
                'image' => 'devices/device1.png',
                'max_current' => 1500,
                'min_current' => 700 ,
                'start_current' => 1200,
            ],
            [
                'name' => 'Device 2',
                'description' => 'The device is a Hair dryer',
                'image' => 'devices/device2.png',
                'max_current' =>2000,
                'min_current' => 1000,
                'start_current' => 1500 ,
            ],
            [
                'name' => 'Device 3',
                'description' => 'The device is a air conditioner',
                'image' => 'devices/device3.png',
                'max_current' => 3000,
                'min_current' => 500,
                'start_current' => 2000,
            ],
            [
                'name' => 'Device 4',
                'description' => 'The device is a refrigerator',
                'image' => 'devices/device4.png',
                'max_current' => 400,
                'min_current' => 100,
                'start_current' => 700,
            ],
            [
                'name' => 'Device 5',
                'description' => 'The device is a Freeza',
                'image' => 'devices/device5.png',
                'max_current' => 700,
                'min_current' => 100,
                'start_current' => 800,
            ],
            [
                'name' => 'Device 6',
                'description' => 'The device is a washing machine',
                'image' => 'devices/device6.png',
                'max_current' => 2500,
                'min_current' => 300,
                'start_current' => 1000,
            ],
            [
                'name' => 'Device 7',
                'description' => 'The device is a  lighting',
                'image' => 'devices/device7.png',
                'max_current' => 15,
                'min_current' => 5,
                'start_current' => 5,
            ],
            [
                'name' => 'Device 8',
                'description' => 'The device is a  fan',
                'image' => 'devices/device8.png',
                'max_current' => 100,
                'min_current' => 10,
                'start_current' => 50,
            ],
        ];
        DB::table('devices')->insert($devices);
        foreach ($devices as $device) {
            $sourcePath = base_path('devices/' . basename($device['image']));
            $destinationPath = public_path($device['image']);
            
            if (!File::exists($destinationPath)) {
                File::copy($sourcePath, $destinationPath);
            }
        }

    }
}
