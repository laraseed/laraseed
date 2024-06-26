<?php
 
namespace Laraseed\Database\Seeders;
 
use Illuminate\Database\Seeder;
use Laraseed\Services\SeederService;
 
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(SeederService $seederService): void
    {
        $seederService->import('languages', 'languages.csv');
    }
}