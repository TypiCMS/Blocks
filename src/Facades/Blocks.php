<?php

namespace TypiCMS\Modules\Blocks\Facades;

use Illuminate\Support\Facades\Facade;

class Blocks extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Blocks';
    }
}
