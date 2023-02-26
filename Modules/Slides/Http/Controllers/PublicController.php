<?php

namespace TypiCMS\Modules\Slides\Http\Controllers;

use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Slides\Models\Slide;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $categories = Slide::published()
            ->order()
            ->with('image')
            ->all();


        return view('slides::public.index')
            ->with(compact('categories'));
    }

    public function show($slug = null): View
    {
        $model = Slide::published()
            ->with([
                'image',
                'images',
                'documents',
            ])
            ->whereSlugIs($slug)
            ->firstOrFail();

        return view('slides::public.show')
            ->with(compact('model'));
    }
}
