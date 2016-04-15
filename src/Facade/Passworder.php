<?php namespace Lucasvdh\Passworder\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Credits to wingman
 */

class Passworder extends Facade
{
    protected static function getFacadeAccessor() { return 'passworder'; }
}
