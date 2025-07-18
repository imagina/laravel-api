<?php

namespace Modules\Iblog\Models;

/**
 * Class Status
 */
class Status
{
    const DRAFT = 0;

    const PENDING = 1;

    const PUBLISHED = 2;

    const UNPUBLISHED = 3;

    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DRAFT => trans('iblog::common.status.draft'),
            self::PENDING => trans('iblog::common.status.pending'),
            self::PUBLISHED => trans('iblog::common.status.published'),
            self::UNPUBLISHED => trans('iblog::common.status.unpublished'),
        ];
    }

    /**
     * Get the available statuses
     */
    public function lists(): array
    {
        return $this->statuses;
    }

    /**
     * Get the post status
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::DRAFT];
    }

    public function index()
    {
        //Instance response
        $response = [];
        //AMp status
        foreach ($this->statuses as $key => $status) {
            array_push($response, ['id' => $key, 'title' => $status]);
        }
        //Repsonse
        return collect($response);
    }
}
