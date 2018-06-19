<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'New']);
        Status::create(['name' => 'Processing']);
        Status::create(['name' => 'Dispatched']);
        Status::create(['name' => 'Return Requested']);
        Status::create(['name' => 'Return Processing']);
        Status::create(['name' => 'Return Completed']);
        Status::create(['name' => 'Refunded']);
    }
}
