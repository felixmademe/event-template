<?php

use App\Participant;
use Illuminate\Database\Seeder;

class ParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Participant::class, 100 )->create();
    }
}
