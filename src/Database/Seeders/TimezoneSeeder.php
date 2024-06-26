<?php
 
namespace Laraseed\Database\Seeders;
 
use Illuminate\Database\Seeder;
use Laraseed\Services\SeederService;
 
class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(SeederService $seederService): void
    {
        $seederService->import('timezones', 'timezones.csv');
    }
}