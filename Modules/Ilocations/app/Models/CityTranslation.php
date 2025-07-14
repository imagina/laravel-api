<?php

namespace Modules\Ilocations\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'ilocations__city_translations';
}
