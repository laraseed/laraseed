<?php
 
namespace Laraseed\Database\Seeders;
 
use Illuminate\Database\Seeder;
use Laraseed\Services\SeederService;
 
class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(SeederService $seederService): void
    {
        $seederService->import('currencies', 'currencies.csv');
    }
}