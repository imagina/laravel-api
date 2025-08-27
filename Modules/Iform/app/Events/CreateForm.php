<?php

namespace Modules\Iform\Events;


class CreateForm
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
