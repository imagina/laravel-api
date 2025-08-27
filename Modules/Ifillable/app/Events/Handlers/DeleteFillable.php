<?php

namespace Modules\Ifillable\Events\Handlers;


class DeleteFillable
{

  public function handle($event): void
  {

    $params = $event->params;
    $model = $params['model'];

    //Delete Fields
    $model->fields()->detach();
  }
}
