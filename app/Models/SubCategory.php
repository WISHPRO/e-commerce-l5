<?php

use LaravelBook\Ardent\Ardent;

class SubCategory extends Ardent
{
    public static $rules = [
        'name' => 'required|between:3,50|unique:sub_categories',
        'banner' => 'image|between:5,2000'
    ];

    protected $fillable = ['name', 'banner'];

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = env('IMG_SUBCATEGORY_HEIGHT');
        $dim['width'] = env('IMG_SUBCATEGORY_WIDTH');
        return $dim;
    }

    /**
     * @return bool
     */
    public function beforeUpdate()
    {
        // only process image if it is there
        if (!is_null($this->banner)) {
            $path = ProcessImage($this, 'banner', env('SUBCATEGORY_IMAGES'), true, $this->getDimensions());

            if ($path === null) {
                return false;
            }

            // assign the reference path to our banner
            $this->banner = $path;

            // since the banner will now be a reference string, we reset the image rules.
            SubCategory::$rules['banner'] = (Input::get('banner')) ? 'image|between:5,2000' : '';

            return true;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('Product')->withTimestamps();
    }

    // a sub-category belongs to a category

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category()
    {
        return $this->belongsTo('Category');
    }
}