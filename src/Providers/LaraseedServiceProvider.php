<?php

declare(strict_types=1);

namespace Laraseed\Providers;

use Illuminate\Support\ServiceProvider;
use Laraseed\Console\Commands\LaraseedDropCommand;
use Laraseed\Console\Commands\LaraseedInstallCommand;

final class LaraseedServiceProvider extends ServiceProvider
{
    public function boot(\Laraseed\Config $config): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LaraseedInstallCommand::class,
                LaraseedDropCommand::class,
            ]);

            foreach ($config->getTables() as $key => $table) {
                $this->publishesMigrations([
                    __DIR__."/../database/migrations/create_{$table['table']}_table.php"
                        => database_path("migrations/" . date('Y_m_d_His')
                             . "_laraseed_create_{$table['table']}_table.php"),
                ], "laraseed-{$key}");
            }
        }
    }
}
