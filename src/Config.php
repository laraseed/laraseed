<?php

namespace Laraseed;

class Config
{

    /**
     * The package version.
     *
     * @var string
     */
    protected $version = '1.0.1';

    /**
     * The tables to choose from.
     *
     * @var array
     */
    private static array $tables = [
        'countries' => [
            'name' => 'Countries',
            'table' => 'countries',
            'model' => 'Country',
        ],
        'currencies' => [
            'name' => 'Currencies',
            'table' => 'currencies',
            'model' => 'Currency',
        ],
        'languages' => [
            'name' => 'Languages',
            'table' => 'languages',
            'model' => 'Language',
        ],
        'timezones' => [
            'name' => 'Timezones',
            'table' => 'timezones',
            'model' => 'Timezone',
        ],
        'us_states' => [
            'name' => 'US States',
            'table' => 'us_states',
            'model' => 'USState',
        ],
        'user_roles' => [
            'name' => 'User Roles',
            'table' => 'user_roles',
            'model' => 'UserRole',
        ],
    ];

    /**
     * Get the package version.
     *
     * @return string The package version.
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Get a copy of the configuration tables array.
     *
     * @return array The tables array.
     */
    public static function getTables(): array
    {
        return self::$tables;
    }

}