<?php

namespace Modules\Ilocations\Events;


class CreateLocation
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
