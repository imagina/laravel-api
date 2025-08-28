<?php

namespace Modules\Ilocation\Events;


class UpdateLocation
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
