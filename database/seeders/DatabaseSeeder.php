<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin user',
            'email' => 'admin@creativsoftcm.com',
        ]);
        $country=new Country();
        $country->name='Cameroon';
        $country->iso='CM';
        $country->code_phone='237';
        $country->currency='XAF';
        $country->save();
        $country=new Country();
        $country->name='Ivoiry coast';
        $country->code_phone='225';
        $country->iso='CI';
        $country->currency='XOF';
        $country->save();
        $country=new Country();
        $country->name='Senegal';
        $country->code_phone='221';
        $country->currency='XOF';
        $country->iso='SN';
        $country->save();
        $country=new Country();
        $country->name='Benin';
        $country->code_phone='229';
        $country->iso='BJ';
        $country->currency='XOF';
        $country->save();
        $country=new Country();
        $country->name='Burkina faso';
        $country->iso='BF';
        $country->code_phone='226';
        $country->currency='XOF';
        $country->save();



/*
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


        ));*/
    }
}
