<?php
use app\Models\Review;
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

        foreach (range( 1, 100 ) as $index) {
            Review::create(
                [
                    'user_id'  => $faker->numberBetween( $min = 15, $max = 112 ),
                    'product_id'    => $faker->numberBetween( $min = 51, $max = 53),
                    'comment' => $faker->text(),
                    'stars'    =>   $faker->numberBetween( $min = 1, $max = 5 ),
                ]
            );
        }
    }
}