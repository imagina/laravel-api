<?php

namespace Modules\Ilocations\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'ilocations__country_translations';
}
