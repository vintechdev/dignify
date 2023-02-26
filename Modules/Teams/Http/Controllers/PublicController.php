<?php

namespace TypiCMS\Modules\Teams\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Teams\Models\Team;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $categories = Team::published()
            ->order()
            ->with('image')
            ->all();


        return view('teams::public.index')
            ->with(compact('categories'));
    }

    public function show($slug = null): View
    {
        $model = Team::published()
            ->with([
                'image',
                'images',
                'documents',
            ])
            ->whereSlugIs($slug)
            ->firstOrFail();

        return view('teams::public.show')
            ->with(compact('model'));
    }
}
