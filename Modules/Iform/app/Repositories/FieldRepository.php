<?php

namespace Modules\Iform\Repositories;

use Imagina\Icore\Repositories\CoreRepository;

interface FieldRepository extends CoreRepository
{
  public function updateOrders($data);
}
