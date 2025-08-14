<?php

namespace Modules\Irentcar\Models;

use Imagina\Icore\Models\CoreModel;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Reservation extends CoreModel
{

    protected $table = 'irentcar__reservations';
    public string $transformer = 'Modules\Irentcar\Transformers\ReservationTransformer';
    public string $repository = 'Modules\Irentcar\Repositories\ReservationRepository';
    public array $requestValidation = [
        'create' => 'Modules\Irentcar\Http\Requests\CreateReservationRequest',
        'update' => 'Modules\Irentcar\Http\Requests\UpdateReservationRequest',
        'validationDate' => 'Modules\Irentcar\Http\Requests\ValidationDateRequest',
        'validationGammasToReservation' => 'Modules\Irentcar\Http\Requests\ValidationGammasToReservationRequest',
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
        'pickup_date',
        'dropoff_date',
        'pickup_office_id',
        'dropoff_office_id',
        'user_id',
        'gamma_id',
        'gamma_office_id',
        'gamma_office_extra_ids',
        'gamma_data',
        'extras_data',
        'gamma_office_price',
        'gamma_office_extra_total_price',
        'total_price',
        'status',
        'options'
    ];

    protected function casts(): array
    {
        return [
            'gamma_data' => 'json',
            'extras_data' => 'json',
            'options' => 'json'
        ];
    }

    protected $appends = [
        'status_title',
        'total_price_usd'
    ];

    public function pickupOffice()
    {
        return $this->belongsTo(Office::class, 'pickup_office_id');
    }

    public function dropoffOffice()
    {
        return $this->belongsTo(Office::class, 'dropoff_office_id');
    }

    public function user()
    {
        return $this->belongsTo("Modules\\Iuser\\Models\\User");
    }

    public function gamma()
    {
        return $this->belongsTo(Gamma::class, 'gamma_id');
    }

    public function statusTitle(): Attribute
    {
        return Attribute::get(function () {
            $status = new ReservationStatus();
            return $status->get($this->status);
        });
    }

    protected function pickupDate(): Attribute
    {
        $localTz = config('app.local_timezone');

        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->timezone($localTz),
            set: fn(string $value) => Carbon::parse($value, $localTz)->setTimezone('UTC')->format('Y-m-d H:i:s'),
        );
    }

    protected function dropoffDate(): Attribute
    {
        $localTz = config('app.local_timezone');

        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->timezone($localTz),
            set: fn(string $value) => Carbon::parse($value, $localTz)->setTimezone('UTC')->format('Y-m-d H:i:s'),
        );
    }

    public function totalPriceUsd(): Attribute
    {
        return Attribute::get(function () {
            $usdRates = $this->options['USDRates'] ?? null;

            if (is_array($usdRates) && isset($usdRates['COP'])) {
                $copRate = (float) $usdRates['COP'];
                $totalPrice = (float) $this->total_price;

                return round($totalPrice / $copRate, 2);
            }


            return 0;
        });
    }


    /**
     * Notification Params
     */
    public function getNotificableParams()
    {
        //Process to get Email (Example: From entity, or settings, etc)
        $email = $this->user->email;

        return [
            'created' => [
                "email" => $email,
                "title" =>  itrans("irentcar::reservation.email.created.title"),
                "content" => "irentcar::emails.reservation.index",
                "extraParams" => [
                    "reservation" => $this
                ],
            ]
        ];
    }
}
