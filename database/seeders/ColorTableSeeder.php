<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('color')->delete();
        
        \DB::table('color')->insert(array (
            0 => 
            array (
                'color_id' => 1,
                'color_name' => 'red',
            ),
            1 => 
            array (
                'color_id' => 2,
                'color_name' => 'black',
            ),
            2 => 
            array (
                'color_id' => 3,
                'color_name' => 'green',
            ),
            3 => 
            array (
                'color_id' => 4,
                'color_name' => 'blue',
            ),
            4 => 
            array (
                'color_id' => 5,
                'color_name' => 'orange',
            ),
        ));
        
        
    }
}