<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        Role::firstOrCreate(['name'=> 'admin']);
        Role::firstOrCreate(['name'=> 'user']);
    }
}
