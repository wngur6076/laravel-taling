<?php

namespace App\Models\NotifyMessage;

use function notify;

class IzitoastNotifyMessage implements NotifyMessage
{
    public function success($message, $title)
    {
        notify()->success($message, $title, 'bottomRight');
    }

    public function error($message, $title)
    {
        notify()->error($message, $title, 'bottomRight');
    }

    public function warning($message, $title)
    {
        notify()->warning($message, $title, 'bottomRight');
    }

    public function info($message, $title)
    {
        notify()->info($message, $title, 'bottomRight');
    }
}
