<?php

namespace Modules\Iform\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;
use Modules\Iuser\Models\User;

class Lead extends CoreModel
{

    protected $table = 'iform__leads';
    public string $transformer = 'Modules\Iform\Transformers\LeadTransformer';
    public string $repository = 'Modules\Iform\Repositories\LeadRepository';
    public array $requestValidation = [
        'create' => 'Modules\Iform\Http\Requests\CreateLeadRequest',
        'update' => 'Modules\Iform\Http\Requests\UpdateLeadRequest',
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
        'form_id',
        'assigned_to_id',
        'values'
    ];

    protected $casts = [
        'values' => 'array'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

}
