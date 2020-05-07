<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('users');
        $data = [
            // 1
            [
                'username' => 'Dustin Jourdan',
                'email' => 'djourdan555@gmail.com',
                'password' => bcrypt('qazwsxedcrfvtgbyhnujmikolp'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        foreach ($data as $d) {
            $table->insert($d);
        }

        $this->command->info('Users created!');
    }
}
