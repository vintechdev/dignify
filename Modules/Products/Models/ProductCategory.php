<?php

namespace TypiCMS\Modules\Products\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;
use Laracasts\Presenter\PresentableTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Models\File;
use TypiCMS\Modules\History\Traits\Historable;

class ProductCategory extends Base implements Sortable
{
    use HasTranslations;
    use Historable;
    use PresentableTrait;
    use SortableTrait;

    protected $presenter = 'TypiCMS\Modules\Products\Presenters\CategoryPresenter';

    protected $guarded = ['id', 'exit'];

    public $translatable = [
        'title',
        'slug',
        'status',
    ];

    public $sortable = [
        'order_column_name' => 'position',
    ];

    public function allForSelect(): array
    {
        $categories = $this->order()
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
        $route = 'admin::edit-product_category';
        if (Route::has($route)) {
            return route($route, $this->id);
        }

        return route('dashboard');
    }

    public function indexUrl(): string
    {
        $route = 'admin::index-product_categories';
        if (Route::has($route)) {
            return route($route);
        }

        return route('dashboard');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
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

    public function homeImage(): BelongsTo
    {
        return $this->belongsTo(File::class, 'home_image_id');
    }

    public function getHomeThumbAttribute(): string
    {
        return $this->present()->homeImage(null, 54);
    }

    public function productCategoryType(): BelongsTo
    {
        return $this->belongsTo(ProductCategoryType::class, 'category_type_id');
    }
}
