<?php

namespace Modules\Ishoe\Models;

use Illuminate\Database\Eloquent\Model;

class ShoeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'ishoe__shoe_translations';
}
