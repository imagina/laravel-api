<?php

namespace Modules\Iuser\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Imagina\Icore\Models\CoreModel;

class Role extends CoreModel
{
    use Translatable;

    public $useAudit = false;

    protected $table = 'iuser__roles';
    public string $transformer = 'Modules\Iuser\Transformers\RoleTransformer';
    public string $repository = 'Modules\Iuser\Repositories\RoleRepository';
    public array $requestValidation = [
        'create' => 'Modules\Iuser\Http\Requests\CreateRoleRequest',
        'update' => 'Modules\Iuser\Http\Requests\UpdateRoleRequest',
    ];
    //Instance external/internal events to dispatch with extraData
    public array $dispatchesEventsWithBindings = [
        //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
        'created' => [
            ['path' => 'Modules\Iform\Events\CreateForm']
        ],
        'creating' => [],
        'updated' => [
            ['path' => 'Modules\Iform\Events\UpdateForm']
        ],
        'updating' => [],
        'deleting' => [
            ['path' => 'Modules\Iform\Events\DeleteForm']
        ],
        'deleted' => []
    ];
    public $translatedAttributes = [
        'title'
    ];
    protected $fillable = [
        'system_name',
        'permissions',
    ];

    protected function casts(): array
    {
        return [
            'permissions' => 'json'
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'iuser__role_user');
    }

    /**
     * NOT USER AUDIT
     */
    /*  public function isSoftDeleting()
    {
        return false;
    } */

    public function form()
    {
        if (isModuleEnabled('Iform')) {
            return app(\Modules\Iform\Relations\FormsRelation::class)->resolve($this);
        }
        return new \Imagina\Icore\Relations\EmptyRelation();
    }
}
