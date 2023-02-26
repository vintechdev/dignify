<?php

namespace TypiCMS\Modules\Products\Facades;

use Illuminate\Support\Facades\Facade;

class Brochures extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Brochures';
    }
}
