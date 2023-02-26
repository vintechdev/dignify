<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductCategory;

class CategoriesApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(ProductCategory::class)
            ->selectFields($request->input('fields.product_categories'))
            ->allowedSorts(['status_translated', 'position', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(ProductCategory $category, Request $request): JsonResponse
    {
        $data = [];
        foreach ($request->all() as $column => $content) {
            if (is_array($content)) {
                foreach ($content as $key => $value) {
                    $data[$column.'->'.$key] = $value;
                }
            } else {
                $data[$column] = $content;
            }
        }

        foreach ($data as $key => $value) {
            $category->$key = $value;
        }
        $saved = $category->save();
        (new Product())->flushCache();

        return response()->json([
            'error' => !$saved,
        ]);
    }

    public function destroy(ProductCategory $category): JsonResponse
    {
        $deleted = $category->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
