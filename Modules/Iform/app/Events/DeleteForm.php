<?php

namespace Modules\Iform\Events;


class DeleteForm
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
