<?php

namespace Modules\Ilocations\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    protected $table = 'ilocations__province_translations';
}
