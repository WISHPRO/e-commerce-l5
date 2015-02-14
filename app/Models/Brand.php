<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class Brand extends Ardent
{
    public static $rules = [
        'name' => 'required|alpha_dash|between:2,15|unique:brands',
        'logo' => 'required|mimes:png|between:1,1000',
    ];

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = env('IMG_BRAND_HEIGHT');
        $dim['width'] = env('IMG_BRAND_WIDTH');
        return $dim;
    }

    public function beforeSave()
    {
        // process the image, only if it is there
        if (!is_null($this->logo)) {
            $path = ProcessImage($this, 'logo', env('BRAND_IMAGES'), true, $this->getDimensions());

            if ($path === null) {
                return false;
            }

            $this->logo = $path;

            Brand::$rules['logo'] = (Input::get('logo')) ? 'mimes:png|size:1,1000' : '';

            return true;
        }
    }

    /**
     * Allows us to delete an image from disk before we delete the actual record
     * @return bool
     */
    public function beforeDelete()
    {
        // find the image on disk and delete it
        $current_image = $this->logo;

        if(ImageExists($current_image))

            return deleteFile($current_image);

    }

    // hydrates on new entries' validation
    public $autoHydrateEntityFromInput = true;
    public $forceEntityHydrationFromInput = true;

    // relationships
    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    protected $fillable = ['name', 'logo'];
}