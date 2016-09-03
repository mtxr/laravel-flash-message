<?php

namespace FlashMessage;

use Illuminate\Support\Facades\Facade;

class Flash extends Facade
{
    const LEVEL_INFO    = FlashNotifier::LEVEL_INFO;
    const LEVEL_SUCCESS = FlashNotifier::LEVEL_SUCCESS;
    const LEVEL_WARNING = FlashNotifier::LEVEL_WARNING;
    const LEVEL_DANGER  = FlashNotifier::LEVEL_DANGER;
    const LEVEL_ERROR   = FlashNotifier::LEVEL_ERROR;

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}
