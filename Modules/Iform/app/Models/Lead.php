<?php

namespace Modules\Iform\Models;

use Imagina\Icore\Models\CoreModel;
use Modules\Iuser\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'created' => [
            [
                'path' => 'Modules\Inotification\Events\SendNotification',
                'extraData' => ['event' => 'created']
            ]
        ],
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

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    /**
     * Notification Params
     */
    public function getNotificableParams(): array
    {
        //Process to get Email (Example: From entity, or settings, etc)
        $email = 'emailto@example.com';

        return [
            'created' => [
                "email" => $email,
                "title" =>  itrans("iform::leads.email.created.title"),
                "content" => "iform::emails.lead",
                "extraParams" => [
                    "lead" => $this,
                    "form" => $this->form
                ],
            ],
        ];
    }

}
