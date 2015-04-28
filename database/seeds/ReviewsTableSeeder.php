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

        foreach (range( 1, 12 ) as $index) {
            Review::create(
                [
                    'user_id'  => $faker->numberBetween( $min = 170, $max = 191 ),
                    'product_id'    => 43,
                    'comment' => $faker->text(),
                    'stars'    =>   $faker->numberBetween( $min = 4.0, $max = 4.8 ),
                ]
            );
        }
    }
}