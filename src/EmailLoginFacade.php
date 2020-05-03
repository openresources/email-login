<?php

namespace Openresources\EmailLogin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Openresources\EmailLogin\Skeleton\SkeletonClass
 */
class EmailLoginFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'email-login';
    }
}
