<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->truncate();
        $user = User::create([
            'name' => 'Administrator',
            // 'slug' => 'admin-blog',
            'email' => 'admin@toko-online.test',
            'password' => bcrypt('secret12'),
            'email_verified_at' => Carbon::now(),
        ]);

        // $user->assignRole('super-admin');

    }
}
