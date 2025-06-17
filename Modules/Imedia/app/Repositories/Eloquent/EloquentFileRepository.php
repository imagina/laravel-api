<?php

namespace Modules\Imedia\Repositories\Eloquent;

use Modules\Imedia\Repositories\FileRepository;
use Imagina\Icore\Repositories\Eloquent\EloquentCoreRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EloquentFileRepository extends EloquentCoreRepository implements FileRepository
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

    /**
     * @param string|int $criteria
     * @param object|null $params
     * @return bool
     */
    public function deleteBy(string|int $criteria, ?object $params = null): bool
    {
        //Instance Query
        $query = $this->model->query();

        //Check field name to criteria
        if (isset($params->filter->field)) $field = $params->filter->field;

        //Include trashed records | SoftDeletes
        //if ($this->hasSoftDeletes()) $query->withTrashed();

        //get model
        $model = $query->where($field ?? 'id', $criteria)->first();

        //Event deleting model
        $this->dispatchesEvents(['eventName' => 'deleting', 'criteria' => $criteria, 'model' => $model]);

        //Delete Model
        if ($model) {
            if (isset($params->filter->forceDelete) && $this->hasSoftDeletes()) $model->forceDelete();
            else $model->delete();
        }

        //Event deleted model
        $this->dispatchesEvents(['eventName' => 'deleted', 'criteria' => $criteria]);

        //Response
        return true;
    }
}
