<?php

use App\Http\Controllers\Controller;

class BackendSubCategoriesController extends Controller
{

    /**
     * Display a listing of sub categories
     *
     * @return Response
     */
    public function index()
    {
        $subcategories = subCategory::with('category')->paginate(5);
        
        return View::make('backend.subcategories.index', compact('subcategories'));
    }

    // retrieve the subcategories count. we want the admin or whouever to create a category first before creating a sub-category
    // this avoids integrity violations, since a sub-cat must belong to a category

    /**
     * Show the form for creating a new subCategory
     *
     * @return Response
     */
    public function create()
    {
        // we first check if any sub-categories exist. Because a sub-category needs to obviously belong to a category
        if ($this->checkSubCategories()) {
            // perform a redirect, az in obviously...did i really need to write this?
            return Redirect::route('backend')->with('message', 'To create a sub-category, you need to first create a category. Create one by clicking ' . link_to_route('categories.create', 'here'))->with('alertclass', 'alert-warning');
        }
        return View::make('backend.subcategories.create');
    }

    private function checkSubCategories()
    {
        return Category::all()->count() === 0;
    }

    /**
     * Store a newly created subCategory in storage.
     *
     * @return Response
     */
    public function store()
    {
        $SubCategory = new SubCategory();
        $SubCategory->name = Input::get('name');
        $SubCategory->alias = Input::get('alias');
        $SubCategory->banner = Input::file('banner');
        $SubCategory->category_id = Input::get('category_id');

        if (!$SubCategory->validate()) {

            return Redirect::back()->withErrors($SubCategory->errors())->withInput()->with('message', $this->FormErrorMsg)->with('alertclass', 'alert-danger');
        }

        if ($SubCategory->save()) {

            return Redirect::route('subcategories.view')->with('message', $this->successMsg)->with('alertclass', 'alert-success');
        } else {

            return Redirect::back()->with('message', 'Adding the sub-category failed because some errors occurred. please fix them')->withErrors($SubCategory->errors())->withInput()->with('alertclass', 'alert-danger');
        }
    }

    /**
     * Display the specified SubCategory.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $subcategory = subCategory::with('category')->findOrFail($id);

        return View::make('backend.subcategories.edit', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified SubCategory.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $subcategory = subCategory::with('category')->findOrFail($id);

        return View::make('backend.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified subCategory in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $subcategory = subCategory::with('category')->findOrFail($id);

        $validator = Validator::make($data = Input::all(), SubCategory::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('message', 'update failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }

        $subcategory->update($data);

        return Redirect::route('subcategories.view')->with('message', 'successfully updated the sub-category with id ' . $id)->with('alertclass', 'alert-success');
    }

    /**
     * Remove the specified subCategory from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        SubCategory::destroy($id);

        return Redirect::route('subcategories.view')->with('message', 'successfully deleted sub-category with id ' . $id)->with('alertclass', 'alert-success');
    }

}
