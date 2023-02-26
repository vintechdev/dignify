<?php

namespace TypiCMS\Modules\Products\Facades;

use Illuminate\Support\Facades\Facade;

class ProductCategories extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ProductCategories';
    }
}
