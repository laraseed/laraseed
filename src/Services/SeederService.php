<?php

namespace Laraseed\Services;

use Illuminate\Support\Facades\DB;

class SeederService
{
    /**
     * Import a CSV file into a database table.
     *
     * @param string $table
     * @param string $file
     * @return void
     */
    public function import(string $table, string $file): void
    {
        $path = dirname(__FILE__, 3) . '/data/' . $file;
        $handle = fopen($path, 'r');

        if (($header = fgetcsv($handle, 1000, ",")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $rowData = array_combine($header, $data);

                DB::table($table)->insert($rowData);
            }
            fclose($handle);
        }
    }
}