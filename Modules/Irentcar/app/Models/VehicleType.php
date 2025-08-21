<?php

namespace Modules\Irentcar\Models;

class VehicleType
{
    const AUTOMOBILE = 0;

    const PICKUP = 1;

    private $data = [];

    public function __construct()
    {
        $this->data = [
            self::AUTOMOBILE => itrans('irentcar::gamma.vehicleType.automobile'),
            self::PICKUP => itrans('irentcar::gamma.vehicleType.pickup'),
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

        return $this->data[self::AUTOMOBILE];
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
