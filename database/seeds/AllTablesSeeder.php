<?php

use Illuminate\Database\Seeder;

class AllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Eloquent::unguard();
      //$path = 'database/data/2019-09-18-megatech_official.sql';
      $path = 'database/data/debtout.sql';
      //DB::unprepared(file_get_contents($path));
      //$this->command->info('All tables seeded!');

      // =============================================================
      // file Path -> Project/app/configs/database.php
      // get the database name, database username, database password
      // =============================================================
      $db     = \Config::get('database.connections.mysql.database');
      $user   = \Config::get('database.connections.mysql.username');
      $pass   = \Config::get('database.connections.mysql.password');

      // $this->command->info($db);
      // $this->command->info($user);
      // $this->command->info($pass);

      // running command line import in php code
      //mysql -u username -p password database_name < file.sql
      exec("mysql -u {$user} -p {$db} < {$path}");
      //echo "Hello";
      // postal_codes.sql is inside root folder
      //https://stackoverflow.com/questions/25906199/laravel-seeding-large-sql-file/25907181
    }
}
