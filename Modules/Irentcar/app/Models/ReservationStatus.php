<?php

namespace Modules\Irentcar\Models;

class ReservationStatus
{
    const PENDING = 0;

    const APPROVED = 1;
    const CANCELLED = 2;

    private $data = [];

    public function __construct()
    {
        $this->data = [
            self::PENDING => itrans('irentcar::reservation.status.pending'),
            self::APPROVED => itrans('irentcar::reservation.status.approved'),
            self::CANCELLED => itrans('irentcar::reservation.status.cancelled'),
        ];
    }

    /**
     * Implementation Validation
     */
    public function lists()
    {
        return $this->data;
    }

    /**
     * Only the value or default
     */
    public function get($dataId)
    {
        if (isset($this->data[$dataId])) {
            return $this->data[$dataId];
        }

        return $this->data[self::APPROVED];
    }

    /**
     * Implementation API
     */
    public function index()
    {
        //Instance response
        $response = [];
        //AMp status
        foreach ($this->data as $key => $status) {
            array_push($response, ['id' => $key, 'title' => $status]);
        }
        //Repsonse
        return collect($response);
    }

    /**
     * Implementation API
     */
    public function show($dataId)
    {
        $title = $this->get($dataId);
        return [
            'id' => $dataId,
            'title' => $title
        ];
    }
}
