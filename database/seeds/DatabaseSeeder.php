<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);

        if( ! DB::table('users')->where('email', 'a.bashet@gmail.com')->first()){
            DB::table('users')->insert([
                'name' => 'Super Admin',
                'email' => 'a.bashet@gmail.com',
                'password' => bcrypt('bashet01'),
                'active' => 1,
                'verified' => 1,
                'verify_token' => md5(time()),
            ]);

            DB::table('role_user')->insert([
                'role_id' => 1,
                'user_id' => 1,
            ]);
        }
    }
}
