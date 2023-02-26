<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Products\Http\Requests\BrochuresFormRequest;
use TypiCMS\Modules\Products\Models\Brochure;
use TypiCMS\Modules\Products\Models\BrochureDetail;
use TypiCMS\Modules\Products\Models\ProductCategory;
use TypiCMS\Modules\Tags\Models\Tag;

class BrochureDetailsAdminController extends BaseAdminController
{
    public function index($brochureId): View
    {
        $brochure = Brochure::query()
            ->with(['ProductCategory', 'ProductCategory.productCategoryType', 'tag'])
            ->findOrFail($brochureId);

        $rows = BrochureDetail::query()
            ->get();

        return view('products::admin.brochure-details.index')
            ->with(['brochure' => $brochure, 'rows' => $rows]);
    }

    public function create($brochureId): View
    {
        $brochure = Brochure::query()
            ->with(['ProductCategory', 'ProductCategory.productCategoryType', 'tag'])
            ->findOrFail($brochureId);

        $model = new BrochureDetail();

        return view('products::admin.brochure-details.create')
            ->with(compact('brochure', 'model'));
    }

    public function edit(BrochureDetail $brochureDetail): View
    {
        $brochure = Brochure::query()
            ->with(['ProductCategory', 'ProductCategory.productCategoryType', 'tag'])
            ->findOrFail($brochureDetail->brochure_id);

        return view('products::admin.brochure-details.edit')
            ->with([
                'model' => $brochureDetail,
               'brochure' => $brochure
            ]);
    }

    public function store(Request $request, $brochureId): RedirectResponse
    {
        $data = $request->except('file_ids');
        $data['brochure_id'] = $brochureId;

        if ($request->has('file')) {
            $dirName = time();
            $storageRelativePath = DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR. $dirName;
            File::makeDirectory(storage_path($storageRelativePath), 0755, true, true);
            $fileName = $request->file->getClientOriginalName();
            $request->file->move(storage_path($storageRelativePath), $fileName);
            $data['file_path'] = $dirName. DIRECTORY_SEPARATOR. $fileName;
        }

        $detail = BrochureDetail::create($data);

        return redirect()->to(route('admin::index-brochure-details', $detail->brochure_id));
    }

    public function update(BrochureDetail $brochureDetail, Request $request): RedirectResponse
    {
        $data = $request->except('file_ids');

        if ($request->has('file')) {
            $dirName = time();
            $storageRelativePath = DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'public'. DIRECTORY_SEPARATOR. $dirName;
            File::makeDirectory(storage_path($storageRelativePath), 0755, true, true);
            $fileName = $request->file->getClientOriginalName();
            $request->file->move(storage_path($storageRelativePath), $fileName);
            $data['file_path'] = $dirName. DIRECTORY_SEPARATOR. $fileName;
        }

        $brochureDetail->update($data);

        return redirect()->to(route('admin::index-brochure-details', $brochureDetail->brochure_id));
    }



    public function files(BrochuresFormRequest $brochure): JsonResponse
    {
        $data = [
            'models' => $brochure->files,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id): RedirectResponse
    {
        if($detail  = BrochureDetail::query()->findOrFail($id)) {
            $detail->delete();
            return redirect()->back()->with(['error' => false]);
        }

        return redirect()->back()->with(['error' => true]);
    }
}
