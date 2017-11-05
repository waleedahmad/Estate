<?php

use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tiers = [
            [
                'name'  =>  'Silver',
                'listings'  =>  50,
            ],
            [
                'name'  =>  'Bronze',
                'listings'  =>  100,
            ],
            [
                'name'  =>  'Gold',
                'listings'  =>  150,
            ],
            [
                'name'  =>  'Platinum',
                'listings'  =>  200,
            ]
        ];

        foreach($tiers as $tier){
            $t = new \App\Tiers();
            $t->name = $tier['name'];
            $t->allowed_listings = $tier['listings'];
            $t->save();
        }
    }
}
