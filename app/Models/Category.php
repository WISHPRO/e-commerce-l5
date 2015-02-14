<?php namespace app\Models;

use LaravelBook\Ardent\Ardent;

class Category extends Ardent
{
    public static $rules = [
        'name' => 'required|between:3,50|unique:categories',
        'alias' => 'alpha_dash|between:3,50',
        'banner' => 'image|between:5,2000',
    ];

    protected $fillable = ['name', 'alias', 'banner'];

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = env('IMG_CATEGORY_HEIGHT');
        $dim['width'] = env('IMG_CATEGORY_WIDTH');
        return $dim;
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        // only process image if it is there
        if (!is_null($this->banner)) {

            $img_path = ProcessImage($this, 'banner', env('CATEGORY_IMAGES'), true, $this->getDimensions());

            if ($img_path === null) {
                return false;
            }

            $this->banner = $img_path;
            // since the banner will now be a reference string, we reset the image rules. did i really have to do this?
            Category::$rules['banner'] = (Input::get('banner')) ? 'image|between:5,2000' : '';
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }
}