<?php

namespace Modules\Ishoe\Models;

use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'ishoe__option_translations';
}
