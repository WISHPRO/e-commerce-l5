<?php
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/20/2015
 * Time: 12:26 PM
 */
class UsersTableSeeder extends Seeder
{

    public function run()
    {

        $faker = Faker::create();

        foreach (range( 1, 100 ) as $index) {
            User::create(
                [

                    'first_name'   => $faker->firstName,
                    'last_name'    => $faker->lastName,
                    'employee_id'  => $faker->numberBetween( $min = 1000, $max = 9999 ),
                    'phone'        => $faker->phoneNumber,
                    'county_id'    => $faker->numberBetween( $min = 1, $max = 5 ),
                    'town'         => $faker->city,
                    'home_address' => $faker->streetAddress,
                    'email'        => $faker->email,
                    'password'     => Hash::make( '123456789' ),
                    'dob' => $faker->dateTime,
                    'gender' => $faker->email,

                ]
            );
        }
    }
}