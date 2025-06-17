<?php

namespace Modules\Imedia\Events\Handlers;


class DeleteFilesInDisk
{


    public function handle($event)
    {

        // All params Event
        $params = $event->params;
        // Extra data custom event entity
        //$extraData = $params['extraData'];

        $model = $params['model'];

        //Delete Thumbnails (Include Main Image)
        $delete = app('Modules\Imedia\Services\ThumbnailService')->deleteThumbnails($model);
    }
}
