<?php

namespace Modules\Iinventory\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'iinventory__inventory_translations';
}
