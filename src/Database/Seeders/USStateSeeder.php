<?php
 
namespace Laraseed\Database\Seeders;
 
use Illuminate\Database\Seeder;
use Laraseed\Services\SeederService;

class USStateSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(SeederService $seederService): void
    {
        $seederService->import('us_states', 'us_states.csv');
    }
}