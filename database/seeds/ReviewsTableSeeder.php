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

        foreach (range( 1, 15 ) as $index) {
            Review::create(
                [
                    'user_id'  => $faker->numberBetween( $min = 169, $max = 191 ),
                    'product_id'    => 40,
                    'comment' => $faker->text(),
                    'stars'    =>   $faker->numberBetween( $min = 4.2, $max = 5 ),
                ]
            );
        }
    }
}