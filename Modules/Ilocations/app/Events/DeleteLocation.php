<?php

namespace Modules\Ilocations\Events;


class DeleteLocation
{
    public mixed $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
