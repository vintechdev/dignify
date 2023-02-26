<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\Brochure;

class BrochuresApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Brochure::class)
            ->with(['tag', 'productCategory', 'productCategory.productCategoryType'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Brochure $category, Request $request): JsonResponse
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

    public function destroy(Brochure $brochure): JsonResponse
    {
        $deleted = $brochure->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
