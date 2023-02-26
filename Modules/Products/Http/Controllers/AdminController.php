<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Products\Http\Requests\FormRequest;
use TypiCMS\Modules\Products\Models\Product;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('products::admin.index');
    }

    public function create(): View
    {
        $model = new Product();

        $model->getAllTagsGroupByCategoryType();
     
        return view('products::admin.create')
            ->with(compact('model'));
    }

    public function edit(Product $product): View
    {
        return view('products::admin.edit')
            ->with([
                'model' => $product,
            ]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');
        $product = Product::create($data);

        return $this->redirect($request, $product);
    }

    public function update(Product $product, FormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');
        $product->update($data);

        return $this->redirect($request, $product);
    }

    public function files(Product $product): JsonResponse
    {
        $data = [
            'models' => $product->files,
        ];

        return response()->json($data, 200);
    }
}
