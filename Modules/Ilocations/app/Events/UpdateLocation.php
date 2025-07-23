<?php

namespace Modules\Ilocations\Events;


class UpdateLocation
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
