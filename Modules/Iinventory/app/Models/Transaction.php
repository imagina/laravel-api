<?php

namespace Modules\Iinventory\Models;

use Imagina\Icore\Models\CoreModel;

class Transaction extends CoreModel
{

  protected $table = 'iinventory__transactions';
  public string $transformer = 'Modules\Iinventory\Transformers\TransactionTransformer';
  public string $repository = 'Modules\Iinventory\Repositories\TransactionRepository';
  public array $requestValidation = [
      'create' => 'Modules\Iinventory\Http\Requests\CreateTransactionRequest',
      'update' => 'Modules\Iinventory\Http\Requests\UpdateTransactionRequest',
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
    'from_inventory_id',
    'to_inventory_id',
    'quantity',
    'item_id',
    'comments'
  ];

  public function fromInventory(){
    return $this->belongsTo(Inventory::class, 'from_inventory_id');
  }

  public function toInventory(){
    return $this->belongsTo(Inventory::class, 'to_inventory_id');
  }

  public function item(){
    return $this->belongsTo(InventoryItem::class, 'item_id');
  }
}
