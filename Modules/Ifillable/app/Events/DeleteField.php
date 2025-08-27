<?php

namespace Modules\Ifillable\Events;


class DeleteField
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
