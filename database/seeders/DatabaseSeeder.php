<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	// inserting page types
        foreach (config('seed_data.page_types') as $value) {
            DB::table('page_type')->insert([
                'name' => $value
            ]);
        }

        // inserting page types
        foreach (config('seed_data.setting_types') as $key=>$value) {
            DB::table('setting_type')->insert([
                'name' => $key,
                'description' => $value
            ]);
        }

        // inserting scripts
        foreach (config('seed_data.scripts') as $key=>$value) {
            DB::table('scripts')->insert([
                'name' => $key,
                'script_body' => $value,
            ]);
        }


        // inserting message types
        foreach (config('seed_data.message_types') as $value) {
            DB::table('message_type')->insert([
                'name' => $value
            ]);
        }

        // insert sample user as the system admin
        DB::table('users')->insert([
           'name' => 'admin',
           'email' => 'admin@crm.com',
           'password' => bcrypt("admin"),
           'is_admin' => 1,
           'is_active' => 1
        ]);
    }
}
