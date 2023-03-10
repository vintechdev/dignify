<?php

namespace TypiCMS\Modules\Slides\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Slides\Http\Requests\FormRequest;
use TypiCMS\Modules\Slides\Models\Slide;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('slides::admin.index');
    }

    public function create(): View
    {
        $model = new Slide();

        return view('slides::admin.create')
            ->with(compact('model'));
    }

    public function edit(Slide $slide): View
    {
        return view('slides::admin.edit')
            ->with([
                'model' => $slide,
            ]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');
        $slide = Slide::create($data);

        return $this->redirect($request, $slide);
    }

    public function update(Slide $slide, FormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');
        $slide->update($data);

        return $this->redirect($request, $slide);
    }

    public function files(Slide $slide): JsonResponse
    {
        $data = [
            'models' => $slide->files,
        ];

        return response()->json($data, 200);
    }
}
