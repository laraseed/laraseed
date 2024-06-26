<?php

namespace Laraseed\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\confirm;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\multiselect;

class LaraseedInstallCommand extends Command
{
    protected $signature = 'laraseed:install {--debug : Show debug information}';
    protected $description = 'Install a database table and seed data into it';

    public function handle(\Laraseed\Config $config): void
    {
        $tables = $this->selectAndFilterTables($config);
        if (empty($tables)) {
            $this->line("No tables to install or update");
            return;
        }

        $this->publishResources($config, $tables);
        if ($this->confirmAction('Run migration and seed?')) {
            $this->runMigrationsAndSeed($config, $tables);
        }

        foreach ($tables as $tableKey) {
            $this->createModel($config->getTables()[$tableKey]);
        }

        $this->info("Tables successfully imported");
    }

    private function selectAndFilterTables(\Laraseed\Config $config): array
    {
        $selectedTables = multiselect(
            label: 'Select which tables you would like to install',
            options: collect($config->getTables())->mapWithKeys(fn ($item, $key) => [$key => $item['name']]),
            required: true
        );

        return array_filter($selectedTables, function ($tableKey) use ($config) {
            $tableName = $config->getTables()[$tableKey]['table'];
            if (DB::getSchemaBuilder()->hasTable($tableName)) {
                $this->line("Table $tableKey already exists. You can run laraseed:drop to select and drop existing tables");
                return false;
            }
            return true;
        });
    }

    private function publishResources(\Laraseed\Config $config, array $tables): void
    {
        foreach ($tables as $tableKey) {
            $table = $config->getTables()[$tableKey];
            $this->executeCommand('vendor:publish', ['--tag' => "laraseed-$tableKey"]);
            $this->line("Migrations for $table[name] published successfully");
        }
    }

    private function runMigrationsAndSeed(\Laraseed\Config $config, array $tables): void
    {
        $this->executeCommand('migrate');
        $this->line("Migration ran successfully.");

        foreach ($tables as $tableKey) {
            $table = $config->getTables()[$tableKey];
            if (!Schema::hasTable($table['table'])) {
                $this->error("Table $tableKey does not exist. Skipping seeder");
                continue;
            }

            $this->executeCommand('db:seed', [
                '--class' => "Laraseed\\Database\\Seeders\\$table[model]Seeder"
            ]);

            $this->line("Seeder for $table[name] ran successfully");
        }
    }

    private function executeCommand(string $command, array $parameters = []): void
    {
        if ($this->option('debug')) {
            $this->call($command, $parameters);
        } else {
            $this->callSilent($command, $parameters);
        }
    }

    private function confirmAction(string $message): bool
    {
        return confirm(label: $message, hint: "This action will modify the database");
    }

    private function createModel(array $table): void
    {
        if ($this->confirmAction("Create model for $table[name]?")) {
            $this->executeCommand('make:model', [
                'name' => $table['model'],
            ]);

            $this->line("Model $table[model] created successfully");
        }
    }
}
