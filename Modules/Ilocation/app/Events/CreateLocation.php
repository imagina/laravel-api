<?php

namespace Modules\Ilocation\Events;


class CreateLocation
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
