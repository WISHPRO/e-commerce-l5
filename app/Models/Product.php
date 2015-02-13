<?php

use LaravelBook\Ardent\Ardent;

class Product extends Ardent
{

    protected $fillable = [
        'name', 'price', 'discount', 'sku', 'quantity', 'description',
        'colors_available',
        'warranty_period', 'image', 'processor',
        'memory', 'storage', 'video_memory', 'image_large',
        'operating_system'
    ];


    // RELATIONSHIPS
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('Category')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands()
    {
        return $this->belongsToMany('Brand')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany('subCategory')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->belongsToMany('Review');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->belongsToMany('Cart')->withPivot('quantity')->withTimestamps();
    }

    /**
     * @return array
     */
    public function getDimensions()
    {
        $dim = [];
        $dim['height'] = env('IMG_PRODUCT_HEIGHT');
        $dim['width'] = env('IMG_PRODUCT_WIDTH');
        return $dim;
    }

    // MODEL EVENTS

    /**
     * @return bool
     */
    public function beforeCreate()
    {
        $this->sku = generateProductSKU();
        return true;
    }

    /**
     * Allows us to process the image before we update/create the product
     * @return bool
     */
    public function beforeSave()
    {
        // if there is a new image, then do sth. otherwise leave the original one
        if ($this->isDirty('image')) {
            // get a large image first, that will be used when zooming
            $this->image_large = ProcessImage($this, 'image', env('PRODUCT_IMAGES'), true, $this->getDimensions());

            // resize the large image, and save it
            $this->image = reduceImage($this->image_large, env('IMG_REDUCE', 3), env('PRODUCT_IMAGES'));

            if (is_null($this->image)) {
                // error. just bail out
                return false;
            }

            return true;
        }
        return true;
    }

    /**
     * Allows us to update pivot table data, for product_categories, product_subcategories,
     * and product_brands
     * since of course the three exist in a many to many relationship with a product
     * I didi't want to jumble all functionality in the controllers update function
     *
     */
    public function afterSave()
    {
        // grab data
        $catID = Input::get('category_id');
        $subCatID = Input::get('sub_category_id');
        $brandID = Input::get('brand_id');
        $productID = $this->id;

        // perform sync
        $this->categories()->sync([$catID], [$productID]);

        $this->brands()->sync([$brandID], [$productID]);

        // since subcategory_id is not a requirement, we may skip it if its not available
        if (!empty($subCatID)) {
            $this->subcategories()->sync([$subCatID], [$productID]);
        }
    }

    // we need to update the relations data in the pivot tables, after updating the main table
    public function afterUpdate()
    {
        // grab data
        $catID = Input::get('category_id');
        $subCatID = Input::get('sub_category_id');
        $brandID = Input::get('brand_id');
        $productID = $this->id;

        // update relationships
        //$this->whereId($this->id)->categories()->updateExistingPivot(, $attributes);
    }

    /**
     * Allows us to delete an image from disk before we delete the actual record
     * @return bool
     */
    public function beforeDelete()
    {
        // skip nulls, for mow
        if(is_null($this->image)){
            return true;
        }
        // find the images on disk and delete em
        $current_image = $this->image;
        $larger_image = $this->image_large;

        // delete the normal image
        if (ImageExists($current_image)) {

            return deleteFile($current_image);
        }
        // delete the large image
        if (ImageExists($larger_image)) {

            return deleteFile($larger_image);
        }

    }
}