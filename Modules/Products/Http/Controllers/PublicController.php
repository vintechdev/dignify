<?php

namespace TypiCMS\Modules\Products\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Pages\Models\Page;
use TypiCMS\Modules\Products\Facades\ProductCategories;
use TypiCMS\Modules\Products\Models\Brochure;
use TypiCMS\Modules\Products\Models\Product;
use TypiCMS\Modules\Products\Models\ProductCategory;
use TypiCMS\Modules\Products\Models\ProductCategoryType;

class PublicController extends BasePublicController
{
    public function index(): View
    {
        $categories = ProductCategory::published()
            ->order()
            ->with('image')
            ->all();

        return view('products::public.index')
            ->with(compact('categories'));
    }

    public function productCategoryTypeDetail($categorySlug = null): View
    {
        $categoryType = ProductCategoryType::published()
            ->with('image')
            ->whereSlugIs($categorySlug)
            ->firstOrFail();

        $models = ProductCategory::published()
            ->with(['image', 'products', 'products.tags'])
            ->where('category_type_id', $categoryType->id)
            ->get();

        return view('products::public.index-of-category-type')
            ->with(compact('models', 'categoryType'));
    }

    public function indexOfCategory($categoryTypeSlug, $categorySlug = null): View
    {
        $category = ProductCategory::published()
            ->with(['image', 'bannerImage'])
            ->whereSlugIs($categorySlug)
            ->firstOrFail();

        $allProducts = Product::published()
            ->select(["products.*", "tags.tag", "tags.slug as tag_slug"])
            ->join("taggables", function ($query) {
                $query->on('taggables.taggable_id', '=', 'products.id');
            })
            ->join('tags', 'tags.id','=', 'taggables.tag_id')
            ->with(['image', 'images'])
            ->where('category_id', $category->id)
            ->where('taggables.taggable_type', "TypiCMS\Modules\Products\Models\Product")
            ->get();

        $productCount = $allProducts->count();

        $productsGroupByTags = $allProducts->groupBy('tag')->sort();

        return view('products::public.index-of-category')
            ->with(compact('productsGroupByTags', 'category', 'productCount'));
    }

    public function show($categorySlug = null, $slug = null): View
    {
        $category = ProductCategories::with('image')
            ->whereSlugIs($categorySlug)
            ->firstOrFail();
        $model = Product::published()
            ->with([
                'image',
                'images',
                'documents',
            ])
            ->whereSlugIs($slug)
            ->firstOrFail();
        if ($category->id != $model->category_id) {
            abort(404);
        }

        return view('products::public.show')
            ->with(compact('model'));
    }

    public function showBrochureList($type, $size): View
    {
        $categoryTypeSlug = ProductCategoryType::query()
            ->whereJsonContains('slug->en', $type)
            ->firstOrFail();

        $page = new Page();
        $page->id = 0;
        $page->title = ["en" => $categoryTypeSlug->title . '-' . $size];

        $pageTitle =  $categoryTypeSlug->title . '-' . $size;

        $brochures = Brochure::query()
            ->select(["brochures.*", "brochures.title as bTitle", "product_categories.title", "tags.slug", "tags.tag"])
            ->join('product_categories',
                'product_categories.id', '=', 'brochures.product_category_id')
            ->join('tags', 'tags.id', '=', 'brochures.tag_id')
            ->where('product_categories.category_type_id', $categoryTypeSlug->id)
            ->where('tags.slug', $size)->get();

        return view('products::public.brochure.list', compact('pageTitle', 'brochures', 'page', 'categoryTypeSlug'));
    }

    public function download($brochureId)
    {
        $brochure = Brochure::query()
            ->with(['brochureDetails', 'brochureDetails.images', 'productCategory', 'tag'])
            ->find($brochureId);

        if (!$brochure) {
            return "";
        }

        $title = "{$brochure->productCategory->title}-{$brochure->tag->slug}";

        $page = new Page();
        $page->id = 0;
        $page->title = ["en" => $title];
        $fileName = "$title.pdf";

        //return view('products::public.brochure.pdf', compact('brochure', 'page'));
        $pdf = \PDF::loadView('products::public.brochure.pdf', compact('brochure', 'page'));

        return $pdf->download($fileName);
    }
}
