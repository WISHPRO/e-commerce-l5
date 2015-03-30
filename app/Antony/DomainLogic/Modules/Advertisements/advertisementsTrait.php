<?php namespace App\Antony\Modules\Advertisements;

use App\Models\Category;
use App\Models\Product;

trait advertisementsTrait
{

    protected $advert;

    /**
     * Attempts to retrieve a random advertisement
     *
     * @return mixed
     */
    public function getAdvert()
    {
        $this->advert = $this->adverts->where('category_id', $this->id)->random();

        return $this->advert;
    }

}