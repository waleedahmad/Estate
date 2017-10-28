<?php

use Illuminate\Database\Seeder;

class DefaultLayouts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Layout::truncate();

        $layouts = [
            [
                'page' => 'home',
                'layout' => 'Home Horizontal Filter'
            ],
            [
                'page' => 'listings',
                'layout' => 'Listing Grid'
            ],
            [
                'page' => 'agents',
                'layout' => 'Agent Listing Grid',
            ],
            [
                'page' => 'contact',
                'layout' => 'Contact'
            ]
        ];

        foreach($layouts as $layout){
            $layout_config = new \App\Layout();
            $layout_config->page_name = $layout['page'];
            $layout_config->layout_name = $layout['layout'];
            $layout_config->save();
        }
        echo 'Layouts Seeded';
    }
}
