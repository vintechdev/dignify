<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Products\Http\Requests\CategoryTypeFormRequest;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductCategoryType;

class CategoryTypesAdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('products::admin.index-category_types');
    }

    public function create(): View
    {
        $model = new ProductCategoryType();
        return view('products::admin.create-category_type')
            ->with(compact('model'));
    }

    public function edit(ProductCategoryType $category): View
    {
        return view('products::admin.edit-category_type')
            ->with(['model' => $category]);
    }

    public function store(CategoryTypeFormRequest $request): RedirectResponse
    {
        $category = ProductCategoryType::create($request->all());

        return $this->redirect($request, $category);
    }

    public function update(ProductCategoryType $category, CategoryTypeFormRequest $request): RedirectResponse
    {
        $category->update($request->all());
        (new Product())->flushCache();

        return $this->redirect($request, $category);
    }
}
