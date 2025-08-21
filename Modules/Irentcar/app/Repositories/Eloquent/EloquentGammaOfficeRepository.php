<?php

namespace Modules\Irentcar\Repositories\Eloquent;

use Modules\Irentcar\Repositories\GammaOfficeRepository;
use Imagina\Icore\Repositories\Eloquent\EloquentCoreRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EloquentGammaOfficeRepository extends EloquentCoreRepository implements GammaOfficeRepository
{
    /**
     * Filter names to replace
     * @var array
     */
    protected array $replaceFilters = [];

    /**
     * Relation names to replace
     * @var array
     */
    protected array $replaceSyncModelRelations = [];

    /**
     * Attribute to define default relations
     * all apply to index and show
     * index apply in the getItemsBy
     * show apply in the getItem
     * @var array
     */
    protected array $with = [/*all => [] ,index => [],show => []*/];

    /**
     * @param Builder $query
     * @param object $filter
     * @param object $params
     * @return Builder
     */
    public function filterQuery(Builder $query, object $filter, object $params): Builder
    {

        /**
         * Note: Add filter name to replaceFilters attribute before replace it
         *
         * Example filter Query
         * if (isset($filter->status)) $query->where('status', $filter->status);
         *
         */


        /**
         * Filter daily availability with date range for specific gamma_office
         */
        if (isset($filter->dailyAvailavility) && isset($filter->dailyAvailavility['startDate']) && isset($filter->dailyAvailavility['endDate'])) {
            $query->with(['dailyAvailabilities' => function ($q) use ($filter) {
                $q->whereDate('date', '>=', $filter->dailyAvailavility['startDate'])
                    ->whereDate('date', '<=', $filter->dailyAvailavility['endDate']);
            }]);
        }



        //Response
        return $query;
    }

    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function syncModelRelations(Model $model, array $data): Model
    {
        //Get model relations data from model attributes
        //$modelRelationsData = ($model->modelRelations ?? []);

        /**
         * Note: Add relation name to replaceSyncModelRelations attribute before replace it
         *
         * Example to sync relations
         * if (array_key_exists(<relationName>, $data)){
         *    $model->setRelation(<relationName>, $model-><relationName>()->sync($data[<relationName>]));
         * }
         *
         */

        //Response
        return $model;
    }
}
