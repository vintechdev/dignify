<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Products\Http\Requests\CategoryFormRequest;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductCategory;

class CategoriesAdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('products::admin.index-categories');
    }

    public function create(): View
    {
        $model = new ProductCategory();

        return view('products::admin.create-category')
            ->with(compact('model'));
    }

    public function edit(ProductCategory $category): View
    {
        return view('products::admin.edit-category')
            ->with(['model' => $category]);
    }

    public function store(CategoryFormRequest $request): RedirectResponse
    {
        $category = ProductCategory::create($request->all());

        return $this->redirect($request, $category);
    }

    public function update(ProductCategory $category, CategoryFormRequest $request): RedirectResponse
    {
        $category->update($request->all());
        (new Product())->flushCache();

        return $this->redirect($request, $category);
    }
}
