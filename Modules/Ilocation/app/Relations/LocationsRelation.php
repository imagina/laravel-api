<?php

namespace Modules\Ilocation\Relations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Imedia\Models\File;

class LocationsRelation
{
    public function resolve(Model $model)
    {
        return $model->morphOne("Modules\Ilocation\Models\Locatable", 'entity');
    }
}
