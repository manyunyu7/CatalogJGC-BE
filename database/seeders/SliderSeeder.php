<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_sliders')->insert([
            'title' => 'Bestari Sarana Instrument',
            'description' => "Elevate your lab's productivity with our essential equipment lineup. From time-saving automated processes to user-friendly interfaces, our products streamline your workflow, letting you focus on groundbreaking discoveries.",
            'image' => '/web_files/slider_image/1700404707.jpg',
            'order' => "1",
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]);
        DB::table('my_sliders')->insert([
            'title' => 'Stay Ahead of Regulations with Compliance Assurance',
            'description' =>"Ensure regulatory compliance effortlessly with our state-of-the-art equipment. Stay ahead of evolving industry standards and guidelines, reducing risks and ensuring that your lab operates seamlessly within regulatory frameworks.",
            'image' => '/web_files/slider_image/1700404949.jpg',
            'order' => "2",
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]);
        DB::table('my_sliders')->insert([
            'title' => "Tailored Solutions for Your Lab's Success",
            'description'=>"No two labs are the same, and neither are their needs. Discover our range of customizable solutions designed to meet the specific requirements of your research. Elevate your lab's success with equipment that adapts to you.",
            'image' => '/web_files/slider_image/1700405021.jpg',
            'order' => "3",
            'created_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->timezone('Asia/Bangkok')->format('Y-m-d H:i:s')
        ]);
    }
}
