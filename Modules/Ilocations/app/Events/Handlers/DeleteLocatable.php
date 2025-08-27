<?php

namespace Modules\Ilocations\Events\Handlers;



class DeleteLocatable
{

    public function handle($event): void
    {

        $params = $event->params;
        $model = $params['model'];

        //Delete Locations
        $model->locations()->detach();
    }
}
