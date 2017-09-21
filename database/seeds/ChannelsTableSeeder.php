<?php

use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Channel::create(['title' => 'Laravel 5.4']);
        \App\Channel::create(['title' => 'Lumen']);
        \App\Channel::create(['title' => 'Vue js']);
        \App\Channel::create(['title' => 'Angular 4']);
        \App\Channel::create(['title' => 'Codeigniter']);
        \App\Channel::create(['title' => 'Unity']);
    }
}
