<?php
namespace frankyso\OnePush;

use Illuminate\Support\Facades\Facade;

class OnePushFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'OnePush';
    }
}
