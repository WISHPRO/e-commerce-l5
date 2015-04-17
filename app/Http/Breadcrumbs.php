<?php

// Home
Breadcrumbs::register(
    'home',
    function ($breadcrumbs) {
        $breadcrumbs->push('Home', route('home'));
    }
);

// Home > About
Breadcrumbs::register(
    'about',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('About', route('about'));
    }
);

// home > policy
Breadcrumbs::register(
    'terms',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Terms of Use', route('terms'));
    }
);

// Home > Contact
Breadcrumbs::register(
    'contact',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Contact', route('contact'));
    }
);

// home > account
Breadcrumbs::register(
    'myaccount',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Account', route('myaccount'));
    }
);

// home > account > login
Breadcrumbs::register(
    'login',
    function ($breadcrumbs) {
        $breadcrumbs->parent('myaccount');
        $breadcrumbs->push('login', route('login'));
    }
);

// home > account > register
Breadcrumbs::register(
    'register',
    function ($breadcrumbs) {
        $breadcrumbs->parent('myaccount');
        $breadcrumbs->push('Register', route('register'));
    }
);

// home > cart
Breadcrumbs::register(
    'cart.view',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('Shopping cart', route('cart.view'));
    }
);

// home > cart > checkout
Breadcrumbs::register(
    'checkout.auth',
    function ($breadcrumbs) {
        $breadcrumbs->parent('cart.view');
        $breadcrumbs->push('Checkout', route('checkout.auth'));
    }
);

// home > [category Name]
Breadcrumbs::register('categories.shop', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->name, route('categories.shop', ['category' => $category->id]));
});

// home > [category Name] > [subcategory Name]
Breadcrumbs::register('subcategories.shop', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');

    $data = $category->category()->get();
    foreach ($data as $cat) {
        $breadcrumbs->push($cat->name, route('categories.shop', ['category' => $cat->id]));
    }

    $breadcrumbs->push($category->name, route('subcategories.shop', ['subcategory' => $category->id]));
});

// home > brands
Breadcrumbs::register(
    'allBrands',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('brands', route('allBrands'));
    }
);

// home > brands > [brand Name]
Breadcrumbs::register('brands.shop', function ($breadcrumbs, $brand) {
    $breadcrumbs->parent('allBrands');
    $breadcrumbs->push($brand->name, route('brands.shop', ['brand' => $brand->id]));
});

// home > products
Breadcrumbs::register(
    'allProducts',
    function ($breadcrumbs) {
        $breadcrumbs->parent('home');
        $breadcrumbs->push('products', route('allProducts'));
    }
);

// home > [category Name] > [subcategory name] > [product Name]
Breadcrumbs::register('product.view', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('home');

    $category = $product->categories()->get();
    $subcategory = $product->subcategories()->get();
    $brand = $product->brands()->get();
    foreach ($category as $cat) {
        $breadcrumbs->push($cat->name, route('categories.shop', ['category' => $cat->id]));
        foreach ($subcategory as $sub) {
            $breadcrumbs->push($sub->name, route('subcategories.shop', ['subcategory' => $sub->id]));
        }
        foreach ($brand as $br) {
            $breadcrumbs->push($br->name, route('brands.shop', ['brand' => $br->id]));
        }

    }

    $breadcrumbs->push("product # " . $product->sku, route('product.view', ['product' => $product->id]));
});