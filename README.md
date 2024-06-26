Laraseed makes it easy to install common datasets for your Laravel project. Current datasets include countries, languages, currencies and more. You will also be given the option to create a corresponding model for each table. I'll be adding more datasets in the future.

## Installation

```
composer require laraseed/laraseed --dev
```

## Installing database tables

```
php artisan laraseed:install
```

The installer will guide you through the dataset installation process.

## Dropping tables

```
php artisan laraseed:drop
```

Laraseed will show you which tables are installed with an option to drop.

## Credits

Timezone list
https://github.com/bproctor/timezones

Great resource for datasets
http://goodcsv.com/

Countries list
https://github.com/lukes/ISO-3166-Countries-with-Regional-Codes
