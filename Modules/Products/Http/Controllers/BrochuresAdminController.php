<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Products\Http\Requests\BrochuresFormRequest;
use TypiCMS\Modules\Products\Models\Brochure;
use TypiCMS\Modules\Products\Models\ProductCategory;
use TypiCMS\Modules\Tags\Models\Tag;

class BrochuresAdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('products::admin.brochures.index');
    }

    public function create(): View
    {
        $model = new Brochure();

        $tags = Tag::query()->get()->pluck('tag', 'id')
            ->all();

        $categories = ProductCategory::query()->with(['productCategoryType'])
            ->get()->map(function ($category) {
                $category->label = $category->productCategoryType->title .' - '. $category->title;
                return $category;
            })->sortBy('label')->pluck('label', 'id')->all();

        return view('products::admin.brochures.create')
            ->with(compact('tags', 'model', 'categories'));
    }

    public function edit(Brochure $brochure): View
    {
        $tags = Tag::query()->get()->pluck('tag', 'id')
            ->all();

        $categories = ProductCategory::query()->with(['productCategoryType'])
            ->get()->map(function ($category) {
                $category->label = $category->productCategoryType->title .' - '. $category->title;
                return $category;
            })->sortBy('label')->pluck('label', 'id')->all();

        return view('products::admin.brochures.edit')
            ->with([
                'model' => $brochure,
                'tags' => $tags,
                'categories'=> $categories
            ]);
    }

    public function store(BrochuresFormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');

        if ($request->has('file')) {
            $dirName = time();
            $storageRelativePath = DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR. $dirName;
            File::makeDirectory(storage_path($storageRelativePath), 0755, true, true);
            $fileName = $request->file->getClientOriginalName();
            $request->file->move(storage_path($storageRelativePath), $fileName);
            $data['file_url'] = $dirName. DIRECTORY_SEPARATOR. $fileName;
        }

        $brochure = Brochure::create($data);

        return $this->redirect($request, $brochure);
    }

    public function update($brochureId, BrochuresFormRequest $request): RedirectResponse
    {
        $brochure = Brochure::query()->findOrFail($brochureId);

        $data = $request->except('file_ids');

        if ($request->has('file')) {
            $dirName = time();
            $storageRelativePath = DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR. $dirName;
            File::makeDirectory(storage_path($storageRelativePath), 0755, true, true);
            $fileName = $request->file->getClientOriginalName();
            $request->file->move(storage_path($storageRelativePath), $fileName);
            $data['file_url'] = $dirName. DIRECTORY_SEPARATOR. $fileName;
        }

        $brochure->update($data);

        return $this->redirect($request, $brochure);
    }

    public function files(BrochuresFormRequest $brochure): JsonResponse
    {
        $data = [
            'models' => $brochure->files,
        ];

        return response()->json($data, 200);
    }
}
