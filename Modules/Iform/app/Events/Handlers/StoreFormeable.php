<?php

namespace Modules\Iform\Events\Handlers;

class StoreFormeable
{
    public function handle($event): void
    {
        // All params Event
        $params = $event->params;

        // Get specific data
        $dataFromRequest = $params['data'];
        $model = $params['model'];

        // Handle Form
        if (!empty($dataFromRequest['form_id'])) {
            $this->handleForm($dataFromRequest, $model);
        }
    }

    /**
     * Handle syncing of the form to the model
     */
    private function handleForm($data, $model): void
    {

        if (!empty($data['form_id'])) {
            $formsId = [$data['form_id']];

            if (method_exists($model, 'form')) {
                $model->form()->sync($formsId);
            }
        }
    }
}
