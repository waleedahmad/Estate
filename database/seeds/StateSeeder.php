<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\State::truncate();

        $states = [
            'Balochistan',
            'Khyber Pakhtunkhwa',
            'Punjab',
            'Sindh',
            'Azad Jammu and Kashmir',
            'Gilgit-Baltistan'
        ];

        foreach($states as $state){
            $s = new \App\State();
            $s->name = $state;
            $s->save();
        }
    }
}
