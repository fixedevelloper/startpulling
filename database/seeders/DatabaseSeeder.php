<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $country=new Country();
        $country->name='Cameroon';
        $country->iso='CM';
        $country->save();
        $country=new Country();
        $country->name='Ivoiry coast';
        $country->iso='CI';
        $country->save();
        DB::table('sims')->insert(array (
            0 =>
                array (

                    'country_id' => 1,
                    'name' => 'Mtn',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'code_court'=>'*126*78954*phone*amount#',
                    'position' => 1
                ),
            1 =>
                array (

                     'country_id' => 1,
                    'name' => 'Orange',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'code_court'=>'*126*78954*phone*amount#',
                    'position' => 2
                ),
            2 =>
                array (

                    'country_id' => 2,
                    'name' => 'Orange',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'code_court'=>'*126*78954*phone*amount#',
                    'position' => 2
                ),
            3 =>
                array (

                    'country_id' => 2,
                    'name' => 'Wave',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'code_court'=>'*126*78954*phone*amount#',
                    'position' => 1
                ),


        ));
    }
}
