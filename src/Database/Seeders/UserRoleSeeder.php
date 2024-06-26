<?php
 
namespace Laraseed\Database\Seeders;
 
use Illuminate\Database\Seeder;
use Laraseed\Services\SeederService;
 
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(SeederService $seederService): void
    {
        $seederService->import('user_roles', 'user_roles.csv');
    }
}