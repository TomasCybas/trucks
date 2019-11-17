<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * DB table name
     * @var string
     */
    protected $table;

    /**
     * CSV filename
     * @var string
     */
    protected $filename;

    public function __construct()
    {
        $this->table = 'cities';
        $this->filename = base_path('database/csv/cities.csv');
    }


    /**
     * Read data from CSV file and return it as an array.
     *
     * @param $filename
     * @param string $delimitor
     * @return array|bool
     */
    public function seedFromCSV ($filename, $delimitor = ',') {
        if(!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        /**
         * @param string $header names of columns in csv. Have to be the same as column names in DB
         */
        $header = ['name', 'country_name'];
        $data = [];

        if(($handle = fopen($filename, 'r')) !== false) {

            while (($row = fgetcsv($handle, 1000, $delimitor)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;

    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->delete();
        $seedData = $this->seedFromCSV($this->filename, ',');
        DB::table($this->table)->insert($seedData);
    }


}
