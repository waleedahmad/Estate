<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Config::truncate();
        $configs = [
            [
                'name'  =>  'app_name',
                'value' =>  'A&A'
            ],
            [
                'name'  =>  'phone',
                'value' =>  '+92 333 4444093'
            ],
            [
                'name'  =>  'address',
                'value' =>  '123 Smith Drive, Arnold, Maryland'
            ],
            [
                'name'  =>  'email',
                'value' =>  'aqeel.09@gmail.com'
            ],
            [
                'name'  =>  'description',
                'value' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing. In metus diam, fermentum in orci sit amet, lobortis congue diam. Interdum et malesuada fames ac ante ipsum primis in faucibus.'
            ],
            [
                'name'  =>  'hottest_listing_description',
                'value' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing. In metus diam, fermentum in orci sit amet, lobortis congue diam. Interdum et malesuada fames ac ante ipsum primis in faucibus.'
            ],

            [
                'name'  =>  'knowledge_agents',
                'value' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing. In metus diam, fermentum in orci sit amet, lobortis congue diam. Interdum et malesuada fames ac ante ipsum primis in faucibus.'
            ],

            [
                'name'  =>  'expertise_guidance',
                'value' =>  'Lorem ipsum dolor sit amet, consectetur adipiscing. In metus diam, fermentum in orci sit amet, lobortis congue diam. Interdum et malesuada fames ac ante ipsum primis in faucibus.'
            ],

            [
                'name'  =>  'newsletter_description',
                'value' =>  'Lorem ipsum dolor amet, consectetur adipiscing elit. Sed ut purus eget nunc ut dignissim cursus at a nisl.'
            ],

            [
                'name'  =>  'footer_title',
                'value' =>  'Get started today for a free home evaluation!'
            ],

            [
                'name'  =>  'footer_description',
                'value' =>  'Lorem ipsum dolor amet, consectetur adipiscing elit. Quisque eget ante vel nunc lorem ipsum rhoncus.'
            ],

            [
                'name'  =>  'facebook',
                'value' =>  'https://facebook.com'
            ],

            [
                'name'  =>  'twitter',
                'value' =>  'https://twitter.com'
            ],

            [
                'name'  =>  'google_plus',
                'value' =>  'https://plus.google.com'
            ]
        ];

        foreach($configs as $config){
            $template_config = new \App\Config();
            $template_config->name = $config['name'];
            $template_config->value = $config['value'];
            $template_config->save();
        }
        echo 'Configuration Seeded';
    }
}
