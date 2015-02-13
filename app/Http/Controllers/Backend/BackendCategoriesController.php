<?php

use App\Http\Controllers\Controller;

class BackendCategoriesController extends Controller
{

    /**
     * Display a listing of categories
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::paginate(5);

        return View::make('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new Category
     *
     * @return Response
     */
    public function create()
    {
        return View::make('backend.categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @return Response
     */
    public function store()
    {
        $category = new Category();
        $category->name = Input::get('name');
        $category->alias = Input::get('alias');
        $category->banner = Input::file('banner');

        if (!$category->validate()) {
            return Redirect::back()->withErrors($category->errors())->withInput()->with('message', $this->FormErrorMsg)->with('alertclass', 'alert-danger');
        }

        if ($category->save()) {
            return Redirect::route('categories.view')->with('message', $this->successMsg)->with('alertclass', 'alert-success');
        } else {
            return Redirect::back()->withErrors($category->errors())->withInput()->with('message', 'Adding the category failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }
    }

    /**
     * Display the specified Category.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return View::make('backend.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return View::make('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $Category = Category::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Category::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('message', 'update failed because some errors occurred. please fix them')->with('alertclass', 'alert-danger');
        }

        $Category->update($data);

        return Redirect::route('categories.view')->with('message', 'successfully updated category with id ' . $id)->with('alertclass', 'alert-success');
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return Redirect::route('categories.view')->with('message', 'successfully deleted category with id ' . $id)->with('alertclass', 'alert-success');
    }

}
