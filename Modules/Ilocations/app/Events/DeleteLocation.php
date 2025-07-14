<?php

namespace Modules\Ilocations\Events;


class DeleteLocation
{
    public $params;

    public function __construct($params = null)
    {
        $this->params = $params;
    }
}
