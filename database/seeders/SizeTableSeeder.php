<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('size')->delete();
        
        \DB::table('size')->insert(array (
            0 => 
            array (
                'size_id' => 1,
                'size_name' => 'S',
            ),
            1 => 
            array (
                'size_id' => 2,
                'size_name' => 'M',
            ),
            2 => 
            array (
                'size_id' => 3,
                'size_name' => 'L',
            ),
        ));
        
        
    }
}