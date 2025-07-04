<?php

namespace Modules\Inotification\Events;


class SendNotification
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
