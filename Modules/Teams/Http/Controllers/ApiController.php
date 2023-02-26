<?php

namespace TypiCMS\Modules\Teams\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Teams\Models\Team;

class ApiController extends BaseApiController
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Team::class)
            ->selectFields($request->input('fields.teams'))
            ->allowedSorts(['status_translated', 'date', 'title_translated'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    /**
     * @param Team $team
     * @param Request $request
     * @return JsonResponse
     */
    protected function updatePartial(Team $team, Request $request): JsonResponse
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
            $team->$key = $value;
        }
        $saved = $team->save();

        return response()->json([
            'error' => !$saved,
        ]);
    }

    /**
     * @param Team $team
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Team $team): JsonResponse
    {
        $deleted = $team->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }

    /**
     * @param Team $team
     * @return Collection
     * @deprecated
     */
    public function files(Team $team): Collection
    {
        return $team->files;
    }

    /**
     * @param Team $team
     * @param Request $request
     * @return JsonResponse
     * @deprecated
     */
    public function attachFiles(Team $team, Request $request): JsonResponse
    {
        return $team->attachFiles($request);
    }

    /**
     * @param Team $team
     * @param File $file
     * @deprecated
     */
    public function detachFile(Team $team, File $file): void
    {
        $team->detachFile($file);
    }
}
