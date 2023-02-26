<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Products\Models\BrochureDetail;

class BrochureDetailsApiController extends BaseApiController
{
    public function index(Request $request, $brochureId): LengthAwarePaginator
    {
        $data = QueryBuilder::for(BrochureDetail::class)
            ->where('brochure_id', $brochureId)
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function destroy(BrochureDetail $brochureDetail): JsonResponse
    {
        $deleted = $brochureDetail->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
