<?php

namespace TypiCMS\Modules\Products\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Products\Presenters\BrochuresPresenter;
use TypiCMS\Modules\Tags\Models\Tag;

class Brochure extends Base
{
    use Historable;
    use PresentableTrait;

    protected $presenter = BrochuresPresenter::class;

    protected $dates = [];

    protected $guarded = ['id', 'exit'];

     public $translatable = [

     ];

    public function uri($locale = null): string
    {
        $locale = $locale ?: config('app.locale');
        $route = $locale.'::'.Str::singular($this->getTable());
        if (Route::has($route)) {
            return route($route, [$this->category->translate('slug', $locale), $this->translate('slug', $locale)]);
        }

        return url('/');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getAllGroupByTypeAndSize()
    {
        return self::query()
            ->select(['tags.tag', 'tags.slug', 'product_categories.category_type_id'])
            ->join('product_categories',
             'product_categories.id', '=', 'brochures.product_category_id')
            ->join('tags', 'tags.id', '=', 'brochures.tag_id')
            ->get()->groupBy('category_type_id');
    }

    public function brochureDetails(): HasMany
    {
        return  $this->hasMany(BrochureDetail::class, 'brochure_id');
    }
}
