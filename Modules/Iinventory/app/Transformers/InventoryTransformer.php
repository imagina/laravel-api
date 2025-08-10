<?php

namespace Modules\Iinventory\Transformers;

use Imagina\Icore\Transformers\CoreResource;

class InventoryTransformer extends CoreResource
{
  /**
   * Attribute to exclude relations from transformed data
   * @var array
   */
  protected array $excludeRelations = [];

  /**
  * Method to merge values with response
  *
  * @return array
  */
  public function modelAttributes($request): array
  {
    return [];
  }
}
