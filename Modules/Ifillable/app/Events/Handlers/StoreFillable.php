<?php

namespace Modules\Ifillable\Events\Handlers;

use Illuminate\Database\Eloquent\Model;
use Modules\Ifillable\Models\Field;

class StoreFillable
{
    public function handle($event)
    {

        $params = $event->params;
        $dataFromRequest = $params['data'];
        $model = $params['model'];

        // Handle Form
        if (!empty($dataFromRequest['fields'])) {
            $this->syncExtraFillable($dataFromRequest['fields'], $model);
        }
    }

    /**
     * Create schedule to entity
     */
    public function syncExtraFillable($params, $model)
    {

        //Validate data fields
        $dataFields = $this->validateExtraFillable($params, $model);

        //Insert New fields
        foreach ($this->formatFillableToDataBase($dataFields, $model) as $field) {
            Field::updateOrCreate(
                ['title' => $field['name'], 'entity_id' => $field['entity_id'], 'entity_type' => $field['entity_type']],
                $field
            );
        }
    }

    /**
     * Return available site locales
     */
    public function getAvailableLocales()
    {
        return array_keys(\LaravelLocalization::getSupportedLocales());
    }

    /**
     * Validate data to keep only fields to sync
     *
     * @param array $extraFields
     * @return array
     */
    public function validateExtraFillable($extraFields = [], $model)
    {
        //Instance response
        $response = [];
        //temp response to save locales
        $localeResponse = [];
        //Get model fillable
        $modelFillable = array_merge(
            $model->getFillable(),//Fillables
            $model->translatedAttributes ?? [],//Translated attributes
            array_keys($model->getRelations()),//Relations
            getIgnoredFields()//Ignored fields
        );
        $defaultLocaleData = array_keys($extraFields[\App::getLocale()] ?? []);
        //Get model translatable fields
        $modelTranslatableAttributes = $model->translatedAttributes ?? [];

        foreach ($extraFields as $keyField => $field) {
            //Validate translatable fields
            if (in_array($keyField, $this->getAvailableLocales())) {
                //Instance language in response
                $localeResponse[$keyField] = [];
                //compare with translatable attributes
                foreach ($field as $keyTransField => $transField) {
                    if (!in_array($keyTransField, $modelTranslatableAttributes)) $localeResponse[$keyField][$keyTransField] = $transField;
                }
            } //Compare with model fillable and model relations
            else if (!in_array($keyField, $modelFillable) && !method_exists($this, $keyField)) {
                if(!in_array($keyField, $defaultLocaleData)) $response[$keyField] = $field;
            }
        }

        // Merge the locale response with the original response to priority locales
        $response = array_merge($response, $localeResponse);
        //Response
        return $response;
    }

    /**
     * Format extra fillable to save in data base
     */
    public function formatFillableToDataBase($extraFields = [], $model = null)
    {
        //Instance response
        $response = [];
        //instance default morph field
        $defaultFields = ['entity_id' => $model->id, 'entity_type' => get_class($model)];

        foreach ($extraFields as $keyField => $field) {
            //Convert translatable fields
            if (in_array($keyField, $this->getAvailableLocales())) {
                foreach ($field as $keyTransField => $transField) {
                    $existKeyField = array_search($keyTransField, array_column($response, 'name'));
                    if ($existKeyField) {
                        $response[$existKeyField][$keyField] = ['value' => $transField];
                    } else {
                        $response[] = array_merge(['name' => $keyTransField, $keyField => ['value' => $transField]], $defaultFields);
                    }
                }
            } else {
                //Convert no translatable fields
                $response[] = array_merge(['name' => $keyField, 'value' => $field], $defaultFields);
            }
        }

        //Response
        return $response;
    }

}
