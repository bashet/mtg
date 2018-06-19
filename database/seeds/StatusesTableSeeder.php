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
        Status::firstOrCreate(['name' => 'New']);
        Status::firstOrCreate(['name' => 'Processing']);
        Status::firstOrCreate(['name' => 'Dispatched']);
        Status::firstOrCreate(['name' => 'Return Requested']);
        Status::firstOrCreate(['name' => 'Return Processing']);
        Status::firstOrCreate(['name' => 'Return Completed']);
        Status::firstOrCreate(['name' => 'Refunded']);
    }
}
