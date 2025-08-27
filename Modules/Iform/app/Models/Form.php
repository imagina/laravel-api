<?php

namespace Modules\Iform\Models;

use Astrotomic\Translatable\Translatable;
use Imagina\Icore\Models\CoreModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends CoreModel
{
    use Translatable;

    protected $table = 'iform__forms';
    public string $transformer = 'Modules\Iform\Transformers\FormTransformer';
    public string $repository = 'Modules\Iform\Repositories\FormRepository';
    public array $requestValidation = [
        'create' => 'Modules\Iform\Http\Requests\CreateFormRequest',
        'update' => 'Modules\Iform\Http\Requests\UpdateFormRequest',
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
    public array $translatedAttributes = [
        'title',
        'submit_text',
        'success_text',
        'description',
    ];
    protected $fillable = [
        'system_name',
        'active',
        'destination_email',
        'user_id',
        'options',
        'form_type',
        'parent_id'
    ];

    protected $casts = [
        'options' => 'json',
        'destination_email' => 'array'
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class)->with('translations')->orderBy('order', 'asc');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo('Modules\Iform\Models\Form', 'parent_id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('sort_order', 'asc');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo("Modules\\Iuser\\Models\\User", 'user_id');
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn(?int $value) => \LaravelLocalization::localizeUrl('/iforms/view/' . $this->id),
        );
    }

}
