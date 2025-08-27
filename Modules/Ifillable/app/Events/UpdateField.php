<?php

namespace Modules\Ifillable\Events;


class UpdateField
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
