<?php

namespace Modules\Inotification\Models;

use Imagina\Icore\Models\CoreModel;

class Notification extends CoreModel
{

    public $useAudit = false;

    protected $table = 'inotification__notifications';
    public string $transformer = 'Modules\Inotification\Transformers\NotificationTransformer';
    public string $repository = 'Modules\Inotification\Repositories\NotificationRepository';
    public array $requestValidation = [
        'create' => 'Modules\Inotification\Http\Requests\CreateNotificationRequest',
        'update' => 'Modules\Inotification\Http\Requests\UpdateNotificationRequest',
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
        'user_id',
        'type',
        'message',
        'icon_class',
        'link',
        'is_read',
        'title',
        'provider',
        'recipient',
        'options',
        'is_action',
        'source'
    ];

    protected function casts(): array
    {
        return [
            'options' => 'json',
            'is_read' => 'bool'
        ];
    }

    protected $appends = ['time_ago'];

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo("Modules\\Iuser\\Models\\User");
    }

    public function recipientUser()
    {
        return $this->belongsTo("Modules\\Iuser\\Models\\User", "recipient");
    }

    /**
     * Return the created time in difference for humans (2 min ago)
     * @return string
     */
    protected function timeAgo(): Attribute
    {
        return Attribute::get(function () {
            return !empty($this->created_at) ? $this->created_at->diffForHumans() : 0;
        });
    }

    protected function sourceData(): Attribute
    {
        return Attribute::get(function ($value) {

            return $value;

            //TODO - Check v10
            //Init default source data
            /* $sourceData = [
                "label" => "General",
                "icon" => "fa-light fa-bell",
                "color" => "#2196f3",
                "backgroundColor" => "#D9D9D9",
            ];

            //Search the source data
            $source = $this->source;
            if ($source) {
                $sources = iconfig('config.notificationSource', true);
                foreach ($sources as $key => $value) {
                    if (is_array($value) && array_key_exists($source, $value)) {
                        $sourceData = array_merge($sourceData, $value[$source]);
                        break;
                    }
                }
            }

            //Response
            return $sourceData; */
        });
    }

    /**
     * Methods
     */
    public function isRead(): bool
    {
        return $this->is_read === true;
    }
}
