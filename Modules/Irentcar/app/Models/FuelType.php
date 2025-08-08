<?php

namespace Modules\Irentcar\Models;

class FuelType
{
    const GASOLINE = 0;

    const DIESEL = 1;

    private $data = [];

    public function __construct()
    {
        $this->data = [
            self::GASOLINE => itrans('irentcar::gamma.fuelType.gasoline'),
            self::DIESEL => itrans('irentcar::gamma.fuelType.diesel'),
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
    public function get($statusId)
    {
        if (isset($this->data[$statusId])) {
            return $this->data[$statusId];
        }

        return $this->data[self::GASOLINE];
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
