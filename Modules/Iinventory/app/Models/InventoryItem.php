<?php

namespace Modules\Iinventory\Models;

use Imagina\Icore\Models\CoreModel;

class InventoryItem extends CoreModel
{

  protected $table = 'iinventory__inventory_items';
  public string $transformer = 'Modules\Iinventory\Transformers\InventoryItemTransformer';
  public string $repository = 'Modules\Iinventory\Repositories\InventoryItemRepository';
  public array $requestValidation = [
      'create' => 'Modules\Iinventory\Http\Requests\CreateInventoryItemRequest',
      'update' => 'Modules\Iinventory\Http\Requests\UpdateInventoryItemRequest',
    ];
  public array $modelRelations = [
    //eg. 'relationName' => 'belongsToMany/hasMany',
  ];
  //Instance external/internal events to dispatch with extraData
  public array $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];
  protected $fillable = [
    'inventory_id',
    'entity_id',
    'entity_type',
    'quantity',
  ];

  public function inventory(){
    return $this->belongsTo(Inventory::class, 'inventory_id');
  }

  public function entity(){
    return $this->morphTo(__FUNCTION__, 'entity_type', 'entity_id');
  }
}
