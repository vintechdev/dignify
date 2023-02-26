<?php

namespace TypiCMS\Modules\Products\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Products\Presenters\ModulePresenter;

class Product extends Base
{
    use HasFiles;
    use HasTranslations;
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $dates = [];

    protected $guarded = ['id', 'exit', 'tags'];

    protected $appends = ['category_name'];

    public $translatable = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
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

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function getCategoryNameAttribute(): ?string
    {
        return $this->category->title ?? null;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getAllTagsGroupByCategoryType(): Collection
    {
        $productsByCategoryTypes = Product::query()
            ->with(['category', 'category.productCategoryType', 'tags'])
            ->published()->get()->groupBy('category.category_type_id');

        $categoryTypeCollection = collect();
        foreach ($productsByCategoryTypes as $categoryTypeKey => $productsByCategoryType) {
            $tags = [];
            foreach ($productsByCategoryType as $product) {
                if ($product->tags()->count() > 0) {
                    $tags = array_merge($tags, $product->tags()->pluck('tag')->toArray());
                }
            }

            $categoryTypeCollection->push([
                'categoryTypeId' => $categoryTypeKey,
                'tags' => array_unique($tags)
            ]);
        }

        return $categoryTypeCollection->keyBy('categoryTypeId');
    }
}
