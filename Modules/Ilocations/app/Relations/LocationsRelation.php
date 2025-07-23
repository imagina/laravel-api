<?php

namespace Modules\Ilocations\Relations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Imedia\Models\File;

class LocationsRelation
{
    public function resolve(Model $model)
    {
        return $model->morphOne("Modules\Ilocations\Models\Locatable", 'entity');
    }
}
