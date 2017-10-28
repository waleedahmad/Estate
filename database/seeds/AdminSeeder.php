<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->email = env('ADMIN_EMAIL');
        $user->name = env('ADMIN_NAME');
        $user->password = bcrypt(env('ADMIN_PASSWORD'));
        $user->image_uri = 'default/default.jpg';
        $user->phone = env('ADMIN_PHONE');
        $user->type = 'admin';
        $user->gender = env('ADMIN_GENDER');
        $user->verified = 1;

        if($user->save()){
            echo 'Administrator Created';
        }

    }
}
