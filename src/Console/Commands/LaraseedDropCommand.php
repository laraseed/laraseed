<?php
 
namespace Laraseed\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\confirm;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\multiselect;

class LaraseedDropCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraseed:drop {--debug : Show debug information}';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop a database table created by Laraseed';

    /**
     * Execute the console command.
     */
    public function handle(\Laraseed\Config $config): void
    {
        $tables = $this->selectTables($config);
        $this->confirmAnddropTables($config, $tables);
    }

    /**
     * Select which tables to install.
     */
    private function selectTables(\Laraseed\Config $config)
    {
        $tableOptions = collect($config->getTables())->mapWithKeys(function ($table, $key) {
            if (Schema::hasTable($key)) {
                return [$key => $table['table']];
            } else {
                return [];
            }
        });

        if ($tableOptions->isEmpty()) {
            $this->line('No tables to drop');
            exit;
        }

        return multiselect(
            label: 'Select which tables you would like to drop',
            options: $tableOptions,
            required: true,
        );
    }

    /**
     * Confirm the drop operation.
     */
    private function confirmAnddropTables(\Laraseed\Config $config, array $tables): void
    {
        if (confirm('Are you sure you want to drop these tables? This cannot be undone')) {
            foreach ($tables as $table) {
                Schema::dropIfExists($table);
                $this->info("Table {$table} dropped successfully");
            }
        }
    }

}
 