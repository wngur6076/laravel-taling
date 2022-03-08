<?php

namespace App\Facades;

use App\Models\NotifyMessage\NotifyMessage;
use Illuminate\Support\Facades\Facade;

class Notify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NotifyMessage::class;
    }
}
