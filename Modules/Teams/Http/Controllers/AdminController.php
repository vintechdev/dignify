<?php

namespace TypiCMS\Modules\Teams\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Teams\Http\Requests\FormRequest;
use TypiCMS\Modules\Teams\Models\Team;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('teams::admin.index');
    }

    public function create(): View
    {
        $model = new Team();

        return view('teams::admin.create')
            ->with(compact('model'));
    }

    public function edit(Team $team): View
    {
        return view('teams::admin.edit')
            ->with([
                'model' => $team,
            ]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');
        $team = Team::create($data);

        return $this->redirect($request, $team);
    }

    public function update(Team $team, FormRequest $request): RedirectResponse
    {
        $data = $request->except('file_ids');
        $team->update($data);

        return $this->redirect($request, $team);
    }

    public function files(Team $team): JsonResponse
    {
        $data = [
            'models' => $team->files,
        ];

        return response()->json($data, 200);
    }
}
