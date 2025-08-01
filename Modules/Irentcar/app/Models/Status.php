<?php

namespace Modules\Irentcar\Models;

class Status
{
    const INACTIVE = 0;

    const ACTIVE = 1;

    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::INACTIVE => itrans('irentcar::office.status.inactive'),
            self::ACTIVE => itrans('irentcar::office.status.active'),
        ];
    }

    /**
     * Implementation Validation
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Only the value or default
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::INACTIVE];
    }

    /**
     * Implementation API
     */
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

    /**
     * Implementation API
     */
    public function show($statusId)
    {
        $title = $this->get($statusId);
        return [
            'id' => $statusId,
            'title' => $title
        ];
    }
}
