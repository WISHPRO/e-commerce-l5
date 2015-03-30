<?php
use App\Models\Review;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Antony
 * Date: 2/20/2015
 * Time: 12:26 PM
 */
class ReviewsTableSeeder extends Seeder
{

    public function run()
    {

        $faker = Faker::create();

        foreach (range( 1, 10 ) as $index) {
            Review::create(
                [
                    'user_id'  => $faker->numberBetween( $min = 8, $max = 9 ),
                    'product_id'    => $faker->numberBetween( $min = 19, $max = 30),
                    'comment' => $faker->realText(),
                    'stars'    =>   $faker->numberBetween( $min = 3, $max = 5 ),
                ]
            );
        }
    }
}