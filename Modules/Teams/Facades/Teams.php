<?php

namespace TypiCMS\Modules\Teams\Facades;

use Illuminate\Support\Facades\Facade;

class Teams extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Teams';
    }
}
