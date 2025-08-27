<?php

namespace Modules\Ifillable\Relations;

use Illuminate\Database\Eloquent\Model;
use Modules\Ifillable\Models\Field;

class FillablesRelation
{
    public function resolve(Model $model)
    {
        return $model->morphMany(Field::class, 'entity')->with('translations');
    }
}
