<?php

namespace TypiCMS\Modules\Products\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\PresentableTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\History\Traits\Historable;

class ProductCategoryType extends Base implements Sortable
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;
    use SortableTrait;

    protected $presenter = 'TypiCMS\Modules\Products\Presenters\CategoryTypePresenter';

    protected $guarded = ['id', 'exit'];

    public $translatable = [
        'title',
        'slug',
        'status',
        'body',
    ];

    public $sortable = [
        'order_column_name' => 'position',
    ];

    public function allForSelect(): array
    {
        $categories = $this
            ->get()
            ->pluck('title', 'id')
            ->all();

        return ['' => ''] + $categories;
    }

    public function getThumbAttribute(): string
    {
        return $this->present()->image(null, 54);
    }

    public function editUrl(): string
    {
        $route = 'admin::edit-product_category_type';
        if (Route::has($route)) {
            return route($route, $this->id);
        }

        return route('dashboard');
    }

    public function indexUrl(): string
    {
        $route = 'admin::index-product_category_types';
        if (Route::has($route)) {
            return route($route);
        }

        return route('dashboard');
    }

    public function productCategories(): BelongsTo
    {
        return $this->hasMany(ProductCategory::class, 'category_type_id')->order();
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function bannerImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'banner_image_id');
    }

    public function getBannerThumbAttribute(): string
    {
        return $this->present()->bannerImage(null, 54);
    }
}
