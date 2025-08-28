<?php

namespace Modules\Ilocation\Events;


class DeleteLocation
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
